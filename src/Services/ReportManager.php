<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 20.01.19
 * Time: 14:47
 */

namespace App\Services;

use App\Repository\ResultRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Psr\Container\ContainerInterface;

class ReportManager
{
    private $resultRepository;

    private $container;

    public function __construct(
        ResultRepository $resultRepository,
        ContainerInterface $container
    ) {
        $this->resultRepository = $resultRepository;
        $this->container = $container;
    }
    public function generateReport(int $id)
    {
        $publicDirectory = $this->container->get('kernel')->getProjectDir() . '/public/';

        $data = $this->resultRepository->findResultsByQuestion($id);

        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();
        $sheet->setCellValue('A1', "HELLO WORLD");
        $sheet->setTitle("Hello World");

        $writer = new Xlsx($spreadSheet);

        $date = (new \DateTime())->format("Y_m_d");
        $excelFilePath = "{$publicDirectory}/question_{$id}_report_{$date}";

        $writer->save($excelFilePath);
    }
}