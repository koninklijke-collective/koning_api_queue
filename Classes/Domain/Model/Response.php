<?php
namespace Keizer\KoningApiQueue\Domain\Model;

/**
 * Model: Response
 *
 * @package Keizer\KoningApiQueue\Domain\Model
 */
class Response extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \Keizer\KoningApiQueue\Domain\Model\Request
     */
    protected $request;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \DateTime
     */
    protected $processedDate;

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return void
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return void
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return \DateTime
     */
    public function getProcessedDate()
    {
        return $this->processedDate;
    }

    /**
     * @param \DateTime $processedDate
     * @return void
     */
    public function setProcessedDate(\DateTime $processedDate)
    {
        $this->processedDate = $processedDate;
    }
}
