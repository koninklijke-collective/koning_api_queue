<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_api.singular',
        'groupName' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_api.plural',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'editlock' => 'editlock',
        'dividers2tabs' => true,
        'iconfile' => 'EXT:koning_api_queue/Resources/Public/Icons/tx_koningapiqueue_domain_model_api.gif',
        'rootLevel' => false,
        'canNotCollapse' => true,
        'hideTable' => false,
        'security' => array(
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ),
    ),
    'interface' => array(
        'showRecordFieldList' => 'identifier, name, description, location, requests'
    ),
    'types' => array(
        0 => array(
            'showitem' => 'identifier, name, description, location, requests'
        )
    ),
    'palettes' => array(),
    'columns' => array(
        'identifier' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_api.identifier',
            'config' => array(
                'type' => 'input',
                'size' => 30,
            )
        ),
        'name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_api.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
            )
        ),
        'description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_api.description',
            'config' => array(
                'type' => 'text',
            )
        ),
        'location' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_api.location',
            'config' => array(
                'type' => 'input',
                'size' => 30,
            )
        ),
        'requests' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_api_queue/Resources/Private/Language/locallang_be.xlf:tx_koningapiqueue_domain_model_api.requests',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_koningapiqueue_domain_model_request',
                'foreign_field' => 'api',
                'minitems' => 1,
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
