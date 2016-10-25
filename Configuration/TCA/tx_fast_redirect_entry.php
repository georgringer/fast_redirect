<?php
defined('TYPO3_MODE') or die();

$ll = 'LLL:EXT:fast_redirect/Resources/Private/Language/locallang.xlf:';

return [
    'ctrl' => [
        'title' => $ll . 'tx_fast_redirect_entry',
        'label' => 'url_from',
        'label_alt' => 'url_to',
        'label_alt_force' => true,
        'default_sortby' => 'ORDER BY url_from',
        'iconfile' => 'EXT:fast_redirect/ext_icon.png',
        'searchFields' => 'url_from,url_to',
    ],
    'interface' => [
        'showRecordFieldList' => 'url_from,url_to'
    ],
    'columns' => [
        'url_from' => [
            'exclude' => 0,
            'label' => $ll . 'tx_fast_redirect_entry.url_from',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required,unique,trim',
            ]
        ],
        'url_to' => [
            'exclude' => 0,
            'label' => $ll . 'tx_fast_redirect_entry.url_to',
            'config' => [
                'type' => 'input',
                'size' => 30, 
                'eval' => 'required,trim',
            ]
        ],
        'status_code' => [
            'exclude' => 0,
            'label' => $ll . 'tx_fast_redirect_entry.status_code',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        $ll . 'tx_fast_redirect_entry.status_code.301',
                        301,
                    ],
                    [
                        $ll . 'tx_fast_redirect_entry.status_code.307',
                        307,
                    ],
                ],
                'default' => 301,
            ]
        ],
    ],
    'types' => [
        0 => [
            'showitem' => 'url_from, --palette--;;paletteCore'
        ]
    ],
    'palettes' => [
        'paletteCore' => [
            'showitem' => 'url_to,status_code,'
        ],
    ]
];