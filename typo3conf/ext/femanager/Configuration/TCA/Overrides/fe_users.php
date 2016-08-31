<?php

/**
 * Table configuration fe_users
 */
$feUsersColumns = [
    'gender' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanager_domain_model_user.gender',
        'config' => [
            'type' => 'radio',
            'items' => [
                [
                    'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
                    'tx_femanager_domain_model_user.gender.item0',
                    '0'
                ],
                [
                    'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
                    'tx_femanager_domain_model_user.gender.item1',
                    '1'
                ]
            ],
        ]
    ],
    'date_of_birth' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanager_domain_model_user.dateOfBirth',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'max' => 20,
            'eval' => 'date',
            'checkbox' => '0',
            'default' => ''
        ]
    ],
    'crdate' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
            'fe_users.crdate',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'datetime',
            'readOnly' => 1,
            'default' => time()
        ]
    ],
    'tstamp' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
            'fe_users.tstamp',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'datetime',
            'readOnly' => 1,
            'default' => time()
        ]
    ],
    'tx_femanager_confirmedbyuser' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
            'fe_users.registrationconfirmedbyuser',
        'config' => [
            'type' => 'check',
            'default' => 0,
        ]
    ],
    'tx_femanager_confirmedbyadmin' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:' .
            'fe_users.registrationconfirmedbyadmin',
        'config' => [
            'type' => 'check',
            'default' => 0,
        ]
    ],
];
$fields = 'crdate, tstamp, tx_femanager_confirmedbyuser, tx_femanager_confirmedbyadmin';

if (!\In2code\Femanager\Utility\ConfigurationUtility::isDisableLogActive()) {
    $feUsersColumns['tx_femanager_log'] = [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:fe_users.log',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_femanager_domain_model_log',
            'foreign_field' => 'user',
            'maxitems' => 1000,
            'minitems' => 0,
            'appearance' => [
                'collapseAll' => 1,
                'expandSingle' => 1,
            ],
        ]
    ];
    $fields .= ', tx_femanager_log';
}

$feUsersColumns['tx_femanager_changerequest'] = [
    'exclude' => 1,
    'label' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:fe_users.changerequest',
    'config' => [
        'type' => 'text',
        'cols' => '40',
        'rows' => '15',
        'wrap' => 'off',
        'readOnly' => 1
    ]
];
$fields .= ', tx_femanager_changerequest';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'gender, date_of_birth',
    '',
    'after:name'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $feUsersColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    '--div--;LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:fe_users.tab, ' . $fields
);
