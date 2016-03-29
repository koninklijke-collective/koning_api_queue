<?php
namespace Keizer\KoningApiQueue\Service;

use Keizer\KoningApiQueue\Domain\Model\Request;
use Keizer\KoningApiQueue\Domain\Model\Response;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Queue service
 *
 * @package Keizer\KoningApiQueue\Service
 */
class QueueService implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * @var \Keizer\KoningApiQueue\Domain\Repository\ApiRepository
     * @inject
     */
    protected $apiRepository;

    /**
     * @var \Keizer\KoningApiQueue\Domain\Repository\RequestRepository
     * @inject
     */
    protected $requestRepository;

    /**
     * @param string $apiIdentifier
     * @param array $params
     * @return Request
     * @throws \Exception
     */
    public function addToQueue($apiIdentifier, $params = ['location' => '', 'method' => '', 'body' => [], 'headers' => []])
    {
        $api = $this->getApiRepository()->findOneByIdentifier($apiIdentifier);
        if ($api !== null) {
            if (isset($params['location']) && isset($params['method'])) {
                /** @var \Keizer\KoningApiQueue\Domain\Model\Api $api */
                $request = new Request();
                $request->setApi($api);
                $request->setLocation($params['location']);
                $request->setMethod($params['method']);

                if (isset($params['body'])) {
                    $request->setBody($params['body']);
                }
                if (isset($params['headers'])) {
                    $request->setHeaders($params['headers']);
                }

                $this->getRequestRepository()->addAndPersist($request);
                return $request;
            } else {
                throw new \Exception('Required params location and/or method not found while requesting API with identifier ' . $apiIdentifier);
            }
        }

        throw new \Exception('API record with identifier ' . $apiIdentifier . ' not found');
    }

    /**
     * @param string $apiIdentifier
     * @param array $params
     * @return Response
     * @throws \Exception
     */
    public function addToQueueAndExecute($apiIdentifier, $params = ['location' => '', 'method' => '', 'body' => [], 'headers' => []])
    {
        $request = $this->addToQueue($apiIdentifier, $params);
        return $this->execute($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function execute(Request $request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request->getApi()->getLocation() . $request->getLocation());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!empty($request->getHeaders())) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $request->getHeaders());
        }

        switch (strtoupper($request->getMethod())) {
            case 'GET':
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request->getBody()));
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request->getBody()));
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'PATCH':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request->getBody()));
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $rawResponse = curl_exec($ch);
        $rawInfo = curl_getinfo($ch);

        $response = new Response();
        $response->setStatusCode($rawInfo['http_code']);
        $response->setBody($rawResponse);
        $response->setRequest($request);
        $response->setProcessedDate(new \DateTime());
        return $response;
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
        if (!isset($this->requestRepository)) {
            $this->requestRepository = $this->getObjectManager()->get('Keizer\\KoningApiQueue\\Domain\\Repository\\RequestRepository');
        }
        return $this->requestRepository;
    }

    /**
     * @return \Keizer\KoningApiQueue\Domain\Repository\ApiRepository
     */
    protected function getApiRepository()
    {
        if (!isset($this->apiRepository)) {
            $this->apiRepository = $this->getObjectManager()->get('Keizer\\KoningApiQueue\\Domain\\Repository\\ApiRepository');
        }
        return $this->apiRepository;
    }
}
