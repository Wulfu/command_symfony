<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DigitResult
 *
 * @ORM\Table(name="digit_result", indexes={@ORM\Index(name="answer", columns={"answer"}), @ORM\Index(name="result_id", columns={"result_id"})})
 * @ORM\Entity
 */
class DigitResult
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="result_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="App\Entity\Result", mappedBy="digitResult")
     */
    private $result;

    /**
     * @var int
     *
     * @ORM\Column(name="answer", type="integer", nullable=false)
     */
    private $answer;

    /**
     * @var int|null
     *
     * @ORM\Column(name="row", type="integer", nullable=true)
     */
    private $row;

    /**
     * @var int|null
     *
     * @ORM\Column(name="col", type="integer", nullable=true)
     */
    private $col;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getResult(): int
    {
        return $this->result;
    }

    /**
     * @param int $result
     * @return DigitResult
     */
    public function setResult(int $result): DigitResult
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return int
     */
    public function getAnswer(): int
    {
        return $this->answer;
    }

    /**
     * @param int $answer
     * @return DigitResult
     */
    public function setAnswer(int $answer): DigitResult
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRow(): ?int
    {
        return $this->row;
    }

    /**
     * @param int|null $row
     * @return DigitResult
     */
    public function setRow(?int $row): DigitResult
    {
        $this->row = $row;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCol(): ?int
    {
        return $this->col;
    }

    /**
     * @param int|null $col
     * @return DigitResult
     */
    public function setCol(?int $col): DigitResult
    {
        $this->col = $col;
        return $this;
    }
}
