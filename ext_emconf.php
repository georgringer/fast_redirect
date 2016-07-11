<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Fast redirect',
    'description' => 'Fast redirects using db entries',
    'category' => 'fe',
    'author' => 'Georg Ringer',
    'author_email' => 'mail@ringer.it',
    'shy' => '',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'modify_tables' => 'tx_fast_redirect_entry',
    'clearCacheOnLoad' => 1,
    'lockType' => '',
    'author_company' => 'ringer.it',
    'version' => '1.0.2',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.10-8.9.99'
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
    'suggests' => array(),
);