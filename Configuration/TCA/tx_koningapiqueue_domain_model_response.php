<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_response.singular',
        'label' => 'status_code',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'editlock' => 'editlock',
        'dividers2tabs' => true,
        'iconfile' => 'EXT:koning_api_queue/Resources/Public/Icons/tx_koningapiqueue_domain_model_response.gif',
        'rootLevel' => false,
        'canNotCollapse' => true,
        'hideTable' => false,
        'security' => array(
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ),
    ),
    'interface' => array(
        'showRecordFieldList' => 'request, processed_date, status_code, body'
    ),
    'types' => array(
        0 => array(
            'showitem' => 'request, processed_date, status_code, body'
        )
    ),
    'palettes' => array(),
    'columns' => array(
        'request' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_response.request',
            'config' => array(
                'readOnly' => true,
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_koningapiqueue_domain_model_request'
            ),
        ),
        'processed_date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_response.processed_date',
            'config' => array(
                'readOnly' => true,
                'type' => 'input',
                'eval' => 'datetime'
            )
        ),
        'status_code' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_response.status_code',
            'config' => array(
                'readOnly' => true,
                'type' => 'input',
                'size' => 30,
            )
        ),
        'body' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_response.body',
            'config' => array(
                'type' => 'text',
                'rows' => 20
            )
        ),
    ),
);
