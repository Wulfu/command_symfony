<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 17.01.19
 * Time: 23:20
 */

namespace App\Command;

use App\Entity\Question;
use App\Entity\Result;
use App\Repository\QuestionRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\ResultRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Psr\Container\ContainerInterface;

/**
 * Class GenerateReportCommand
 * @package App\Command
 * @property QuestionRepository $questionRepository
 * @property ResultRepository $resultRepository
 */
class GenerateReportCommand extends Command
{
    private $resultRepository;

    private $questionRepository;

    private $container;

    public function __construct(
        ResultRepository $resultRepository,
        QuestionRepository $questionRepository,
        ContainerInterface $container
    ) {
        $this->resultRepository = $resultRepository;
        $this->questionRepository = $questionRepository;
        $this->container = $container;

        parent::__construct();
    }

    protected static $defaultName = 'app:generate_report';

    protected function configure()
    {
        $this
            ->setDescription('Generate xlsx report')
            ->setHelp('Generates a XLSX report from database results specified by id question')
            ->addArgument('question_id', InputArgument::REQUIRED, 'Question id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Started generate report process...");
        $id = $input->getArgument('question_id');

        $publicDirectory = $this->container->get('kernel')->getProjectDir() . '/public/';

        /** @var Question $question */
        $output->writeln("Retrieving question data...");
        $question = $this->questionRepository->find($id);

        if(is_null($question)) {
            $output->writeln("Process stopped due to exception:");
            throw new \Exception("Could not retrieve question");
        }

        $output->writeln("Retrieving results data...");
        $results = $this->resultRepository->findResultsByQuestion($id);

        if(is_null($results)) {
            $output->writeln("Process stopped due to exception:");
            throw new \Exception("Could not retrieve results");
        }

        $data = [];

        $output->writeln("Processing data for export...");

        /** @var Result $result */
        foreach($results as $result) {
            $answerId = $result->getDigitResult()->getAnswer();
            $data[] = [
                $result->getLogId(),
                $result->getCreatedAt()->format("H:i"),
                $question->{Question::ANSWER_METHOD . $answerId}()
            ];
        }

        $headers = [
            'log_id',
            'created_at',
            'answer text'
        ];

        $output->writeln("Exporting to xlsx");

        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();

        $sheet->setCellValue('A1', $question->getTitle());
        $sheet->fromArray($headers, null, 'A2');
        $sheet->fromArray($data, null, 'A3');
        $sheet->setTitle("question_report");

        $writer = new Xlsx($spreadSheet);

        $date = (new \DateTime())->format("Y_m_d");
        $excelFilePath = "{$publicDirectory}/question_{$id}_report_{$date}.xlsx";

        $output->writeln("Saving file to public directory");

        $writer->save($excelFilePath);

        $output->writeln("Done!");
    }
}