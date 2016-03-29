<?php
namespace Keizer\KoningApiQueue\Domain\Model;

/**
 * Model: Api
 *
 * @package Keizer\KoningApiQueue\Domain\Model
 */
class Api extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Keizer\KoningApiQueue\Domain\Model\Request>
     * @lazy
     */
    protected $requests;

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
        $this->requests = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $requests
     * @return void
     */
    public function setRequests(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $requests)
    {
        $this->requests = $requests;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function addRequest(Request $request)
    {
        $this->requests->attach($request);
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return void
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
}