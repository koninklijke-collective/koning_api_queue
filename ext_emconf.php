<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'API Queue',
    'description' => 'Queue your API requests and view them in the backend',
    'category' => 'module',
    'version' => '1.0.3',
    'state' => 'deprecated',
    'uploadFolder' => false,
    'clearCacheOnLoad' => true,
    'author' => 'Jesper Paardekooper',
    'author_email' => 'j.paardekooper@develement.nl',
    'author_company' => 'DevElement',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-8.99.99'
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
    'autoload' => array(
        'psr-4' => array(
            'Keizer\\KoningApiQueue\\' => 'Classes'
        )
    ),
);
