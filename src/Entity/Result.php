<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 *
 * @ORM\Table(name="result", indexes={@ORM\Index(name="survey_id", columns={"survey_id"}), @ORM\Index(name="result_log_id_index", columns={"log_id"})})
 * @ORM\Entity
 */
class Result
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
     * @ORM\Column(name="survey_id", type="integer", nullable=false)
     */
    private $surveyId;

    /**
     * @var int
     *
     * @ORM\Column(name="log_id", type="integer", nullable=false)
     */
    private $logId;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="results")
     */
    private $question;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted = '0';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DigitResult")
     */
    private $digitResult;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Result
     */
    public function setId(int $id): Result
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSurveyId(): int
    {
        return $this->surveyId;
    }

    /**
     * @param int $surveyId
     * @return Result
     */
    public function setSurveyId(int $surveyId): Result
    {
        $this->surveyId = $surveyId;
        return $this;
    }

    /**
     * @return int
     */
    public function getLogId(): int
    {
        return $this->logId;
    }

    /**
     * @return Question
     */
    public function getQuestion(): Question
    {
        return $this->question;
    }

    /**
     * @param int $question
     * @return Result
     */
    public function setQuestion(int $question): Result
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Result
     */
    public function setCreatedAt(\DateTime $createdAt): Result
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime|null $deletedAt
     * @return Result
     */
    public function setDeletedAt(?\DateTime $deletedAt): Result
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     * @return Result
     */
    public function setIsDeleted(bool $isDeleted): Result
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }

    /**
     * @return DigitResult
     */
    public function getDigitResult(): DigitResult
    {
        return $this->digitResult;
    }
}
