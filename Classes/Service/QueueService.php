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
        $curlOptions = [
            CURLOPT_URL => $request->getApi()->getLocation() . $request->getLocation(),
            CURLOPT_RETURNTRANSFER => true
        ];

        if (!empty($request->getHeaders())) {
             $curlOptions[CURLOPT_HTTPHEADER] = $request->getHeaders();
        }

        switch (strtoupper($request->getMethod())) {
            case 'GET':
                $curlOptions[CURLOPT_HTTPGET] = true;
                break;
            case 'POST':
                $curlOptions[CURLOPT_POST] = true;
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request->getBody()));
                break;
            case 'PUT':
                $curlOptions[CURLOPT_POST] = true;
                $curlOptions[CURLOPT_POSTFIELDS] = http_build_query($request->getBody()));
                $curlOptions[CURLOPT_CUSTOMREQUEST] = 'PUT';
                break;
            case 'PATCH':
                $curlOptions[CURLOPT_POST] = true;
                $curlOptions[CURLOPT_POSTFIELDS] = http_build_query($request->getBody()));
                $curlOptions[CURLOPT_CUSTOMREQUEST] = 'PATCH';
                break;
            case 'DELETE':
                $curlOptions[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                break;
        }

        curl_setopt_array($ch, $curlOptions);
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
        if ($this->requestRepository === null) {
            $this->requestRepository = $this->getObjectManager()->get('Keizer\\KoningApiQueue\\Domain\\Repository\\RequestRepository');
        }
        return $this->requestRepository;
    }

    /**
     * @return \Keizer\KoningApiQueue\Domain\Repository\ApiRepository
     */
    protected function getApiRepository()
    {
        if ($this->apiRepository === null) {
            $this->apiRepository = $this->getObjectManager()->get('Keizer\\KoningApiQueue\\Domain\\Repository\\ApiRepository');
        }
        return $this->apiRepository;
    }
}
