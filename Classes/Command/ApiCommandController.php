<?php
namespace Keizer\KoningApiQueue\Command;

use Keizer\KoningApiQueue\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Extbase command: API queue management
 *
 * @package Keizer\KoningApiQueue\Command
 */
class ApiCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController
{
    /**
     * @var \Keizer\KoningApiQueue\Domain\Repository\RequestRepository
     * @inject
     */
    protected $requestRepository;

    /**
     * @var \Keizer\KoningApiQueue\Domain\Repository\ResponseRepository
     * @inject
     */
    protected $responseRepository;

    /**
     * @var \Keizer\KoningApiQueue\Service\QueueService
     * @inject
     */
    protected $queueService;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @return bool
     */
    public function processQueueCommand()
    {
        $requests = $this->getRequestRepository()->findByLastProcessDateAndLimit('', $this->settings['process.']['limit']);
        if ($requests->count() > 0) {
            $this->outputLine('=> Processing %d requests', [$requests->count()]);
            foreach ($requests as $request) {
                /** @var \Keizer\KoningApiQueue\Domain\Model\Request $request */
                $this->outputLine(
                    '  => Requesting location: %s (%s)',
                    [$request->getApi()->getLocation() . $request->getLocation(), $request->getMethod()]
                );

                $response = $this->getQueueService()->execute($request);
                $this->outputLine('       - Response code %s', [$response->getStatusCode()]);
            }
        } else {
            $this->outputLine('No requests to process');
        }
        return true;
    }

    /**
     * @return bool
     */
    public function dataRetentionCommand()
    {
        $retentionDate = new \DateTime();
        $retentionInterval = new \DateInterval('PT' . $this->settings['retention.']['period'] . 'S');
        $retentionDate->sub($retentionInterval);

        $requests = $this->getRequestRepository()->findRetentionData($retentionDate, $this->settings['retention.']['limit']);
        if ($requests->count() > 0) {
            $this->outputLine('Removing %d requests', [$requests->count()]);
            foreach ($requests as $request) {
                /** @var \Keizer\KoningApiQueue\Domain\Model\Request $request */
                foreach ($request->getResponses() as $response) {
                    $this->getResponseRepository()->remove($response);
                }
                $this->getRequestRepository()->remove($request);
            }
        } else {
            $this->outputLine('No requests to remove');
        }
        return true;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function callCommandMethod()
    {
        if (!ConfigurationUtility::isValid()) {
            throw new \Exception('No correct settings found for koning_api_queue extension');
        }

        $this->settings = ConfigurationUtility::getConfiguration();
        parent::callCommandMethod();
    }

    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected function getObjectManager()
    {
        return GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
    }

    /**
     * @return \Keizer\KoningApiQueue\Domain\Repository\RequestRepository
     */
    protected function getRequestRepository()
    {
        if ($this->requestRepository === null) {
            $this->requestRepository = $this->getObjectManager()->get('Keizer\\KoningApiQueue\\Domain\\Repository\\RequestRepository');
        }
        return $this->requestRepository;
    }

    /**
     * @return \Keizer\KoningApiQueue\Domain\Repository\ResponseRepository
     */
    protected function getResponseRepository()
    {
        if ($this->responseRepository === null) {
            $this->responseRepository = $this->getObjectManager()->get('Keizer\\KoningApiQueue\\Domain\\Repository\\ResponseRepository');
        }
        return $this->responseRepository;
    }

    /**
     * @return \Keizer\KoningApiQueue\Service\QueueService
     */
    protected function getQueueService()
    {
        if ($this->queueService === null) {
            $this->queueService = $this->getObjectManager()->get('Keizer\\KoningApiQueue\\Service\\QueueService');
        }
        return $this->queueService;
    }
}
