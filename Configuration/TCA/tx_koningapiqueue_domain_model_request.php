<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.singular',
        'label' => 'location',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'editlock' => 'editlock',
        'dividers2tabs' => true,
        'iconfile' => 'EXT:koning_api_queue/Resources/Public/Icons/tx_koningapiqueue_domain_model_request.gif',
        'rootLevel' => false,
        'canNotCollapse' => true,
        'hideTable' => false,
        'security' => array(
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ),
    ),
    'interface' => array(
        'showRecordFieldList' => 'api, location, method, body, headers, last_process_date, responses'
    ),
    'types' => array(
        0 => array(
            'showitem' => 'api, location, method, body, headers, last_process_date, responses'
        )
    ),
    'palettes' => array(),
    'columns' => array(
        'api' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.api',
            'config' => array(
                'readOnly' => true,
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_koningapiqueue_domain_model_api'
            ),
        ),
        'location' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.location',
            'config' => array(
                'readOnly' => true,
                'type' => 'input',
                'size' => 30,
            )
        ),
        'method' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.method',
            'config' => array(
                'readOnly' => true,
                'type' => 'select',
                'renderType' => 'selectSingle',
                'size' => 1,
                'items' => array(
                    array(
                        'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.method.I.DELETE',
                        'DELETE'
                    ),
                    array(
                        'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.method.I.GET',
                        'GET'
                    ),
                    array(
                        'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.method.I.PATCH',
                        'PATCH'
                    ),
                    array(
                        'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.method.I.POST',
                        'POST'
                    ),
                    array(
                        'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.method.I.PUT',
                        'PUT'
                    ),
                ),
            )
        ),
        'body' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.body',
            'config' => array(
                'type' => 'text',
                'rows' => 20
            )
        ),
        'headers' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.headers',
            'config' => array(
                'type' => 'text',
                'rows' => 20
            )
        ),
        'last_process_date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.last_process_date',
            'config' => array(
                'readOnly' => false,
                'type' => 'input',
                'eval' => 'datetime'
            )
        ),
        'responses' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_request.responses',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_koningapiqueue_domain_model_response',
                'foreign_field' => 'request',
                'minitems' => 0,
                'maxitems' => 999,
                'appearance' => array(
                    'collapse' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
    ),
);
