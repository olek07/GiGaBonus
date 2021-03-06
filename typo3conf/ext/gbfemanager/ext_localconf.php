<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


/** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);

$signalSlotDispatcher->connect(
    \In2code\Femanager\Controller\EditController::class,  // Signal class name
    'updateActionBeforePersist',                                  // Signal name
    \Gigabonus\Gbfemanager\Slots\BeforePersist::class,        // Slot class name
    'setUsernameEqualToEmail'                               // Slot name
);

$signalSlotDispatcher->connect(
    \In2code\Femanager\Controller\NewController::class,     // Signal class name
    'confirmCreateRequestActionBeforePersist',              // Signal name
    \Gigabonus\Gbfemanager\Slots\BeforePersist::class,      // Slot class name
    'confirmCreateRequestAction'                            // Slot name
);



\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'In2code.femanager',
    'Pi1',
    [
        'User' => 'list, show, fileUpload, fileDelete, validate, loginAs',
        'New' => 'create, new, confirmCreateRequest, createStatus, newAjax',
        'Edit' => 'edit, update, delete, confirmUpdateRequest',
        'ChangeMobileNumber' => 'edit, update',
        'Invitation' => 'new, create, edit, update, delete, status',
        'RestorePassword' => 'edit,save',
        'SendConfirmMail' => 'send'
    ],
    [
        'User' => 'list, fileUpload, fileDelete, validate, loginAs',
        'New' => 'create, new, confirmCreateRequest, createStatus, newAjax',
        'Edit' => 'edit, update, delete, confirmUpdateRequest',
        'ChangeMobileNumber' => 'edit, update',
        'Invitation' => 'new, create, edit, update, delete',
        'RestorePassword' => 'edit,save',
        'SendConfirmMail' => 'send'
    ]
);

/*
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
// 'In2code.femanager',
    'In2code.femanager',
    'Ajaxregistrationform',
    [
        'New' => 'newAjax, createAjax'
    ],
    [
        'New' => 'newAjax, createAjax'
    ]
);
*/

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    // 'In2code.femanager',
    'Gigabonus.gbfemanager',
    'Pi2',
    [
        'Validation' => 'validate' 
    ],
    [
        'Validation' => 'validate'
    ]
);




/* 
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['In2code\\Femanager\\Controller\\NewController'] = array(
    'className' => 'Gigabonus\\Gbfemanager\\Xclass\\NewController'
);
*/

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['In2code\\Femanager\\Domain\\Validator\\ServersideValidator'] = array(
    'className' => 'Gigabonus\\Gbfemanager\\Domain\\Validator\\ServersideValidator'
);




## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/PageTS.ts">'); 



$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:femanager/Resources/Private/Language/locallang.xlf'][]
    = 'EXT:gbfemanager/Resources/Private/Language/locallang.xlf';


$TYPO3_CONF_VARS['FE']['eID_include']['cities'] = 'EXT:gbfemanager/Classes/Cities.php';

// eID for Field Validation (FE)
// $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['gbfemanagerValidate'] = 'EXT:gbfemanager/Classes/Eid/ValidateEid.php';
