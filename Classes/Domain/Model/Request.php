<?php
namespace Keizer\KoningApiQueue\Domain\Model;

/**
 * Model: Request
 *
 * @package Keizer\KoningApiQueue\Domain\Model
 */
class Request extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \Keizer\KoningApiQueue\Domain\Model\Api
     */
    protected $api;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $headers;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Keizer\KoningApiQueue\Domain\Model\Response>
     * @lazy
     */
    protected $responses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->responses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @var \DateTime
     */
    protected $lastProcessDate = null;

    /**
     * @return Api
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param Api $api
     * @return void
     */
    public function setApi(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return void
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return json_decode($this->body, true);
    }

    /**
     * @param string $body
     * @return void
     */
    public function setBody($body)
    {
        $this->body = json_encode($body);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return json_decode($this->headers, true);
    }

    /**
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers)
    {
        $this->headers = json_encode($headers);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $responses
     * @return void
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
    }

    /**
     * @param Response $response
     * @return void
     */
    public function addResponse(Response $response)
    {
        $this->responses->attach($response);
    }

    /**
     * @return \DateTime
     */
    public function getLastProcessDate()
    {
        return $this->lastProcessDate;
    }

    /**
     * @param \DateTime $lastProcessDate
     * @return void
     */
    public function setLastProcessDate(\DateTime $lastProcessDate)
    {
        $this->lastProcessDate = $lastProcessDate;
    }
}
