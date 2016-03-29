=============
Documentation
=============

This extension provides functionality for extension developers to handle requests to third party API's. It features:

- A service to execute an API request straight away or queue it;
- A queue runner Scheduler task that executes queued API requests;
- The ability to manually trigger previously executed API requests;
- The ability to view information about the request and response headers/body;
- A data retention Scheduler task that removes old API requests and responses.

============================
Installation & Configuration
============================
Include the static template and configure the following options through the Extension Manager:

- ``process.limit``: Max amount of requests handled per cycle of the queue runner
- ``retention.limit``: Max amount of requests handled per cycle of the data retention runner
- ``retention.period``: Amount of time (in seconds) to keep completed requests/responses

Finally, make sure the ``{$module.tx_koningapiqueue.persistence.storagePid}`` constant is set to the page where you wish to keep your records.

**Setup an API**

Add an API record to the ``{$module.tx_koningapiqueue.persistence.storagePid}`` folder. An API consists of the following fields:

- ``Identifier``: Unique identifier to use in your code
- ``Name``: Simple name
- ``Description``: Description of the API
- ``Location``: Base URL of the API (for instance: https://api.instagram.com/v1/) 

**Add the scheduler tasks**
The scheduler tasks are Extbase CommandController Tasks and are called:
- KoningApiQueue Queue: processQueue
- KoningApiQueue Queue: dataRetention

=============
Usage in code
=============
Inject the queue service in your extension (this example assumes you added an API with identifier 'instagram_api':

.. code-block:: php

    /**
     * @var \Keizer\KoningApiQueue\Service\QueueService
     * @inject
     */
    protected $apiQueueService;

Add an API call to the queue:

.. code-block:: php

   $this->apiQueueService->addToQueue(
       'instagram_api',
           [
              'location' => 'oauth/access_token',
              'method' => 'POST',
              'body' => [
                  'client_id' => 'sampleClientId',
                  'client_secret' => 'sampleClientSecret',
                  'grant_type' => 'sampleGrantType',
              ],
              'headers' => [
                  'Content-Type: text/json'
              ]
          ]
      );


If you don't want to wait for the queue runner to execute your API call, you can execute it directly by calling: ``addToQueueAndExecute`` instead.

===============================
Rerun already executed requests
===============================
Edit the 'API Request' TCA record and clear the 'Last process date' field. It will then be added to the queue.
