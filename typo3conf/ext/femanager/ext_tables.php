<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/**
 * FE Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('femanager', 'Pi1', 'FE_Manager');

/**
 * Include Backend Module
 */
if (!\In2code\Femanager\Utility\ConfigurationUtility::isDisableModuleActive() &&
    !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'In2code.femanager',
        'web',
        'm1',
        '',
        [
            'UserBackend' => 'list,userLogout'
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:femanager/ext_icon.svg',
            'labels' => 'LLL:EXT:femanager/Resources/Private/Language/locallang_mod.xlf',
        ]
    );
}

/**
 * Static TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'femanager',
    'Configuration/TypoScript/Main',
    'Main Settings'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'femanager',
    'Configuration/TypoScript/Layout',
    'Add Layout CSS'
);

/**
 * Flexform
 */
$pluginSignature = str_replace('_', '', 'femanager') . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:femanager/Configuration/FlexForms/FlexFormPi1.xml'
);

/**
 * Disable non needed fields in tt_content
 */
$TCA['tt_content']['types']['list']['subtypes_excludelist']['femanager_pi1'] = 'select_key';
