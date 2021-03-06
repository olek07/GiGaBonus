<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Gigabonus.' . $_EXTKEY,
	'Transactions',
	'My account - Transactions'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Gigabonus.' . $_EXTKEY,
	'Dashboard',
	'My account - Dashboard'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Gigabonus.' . $_EXTKEY,
	'Payment',
	'My account - Payment'
);




\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'GigaBonus Account');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_gbaccount_domain_model_transaction', 'EXT:gbaccount/Resources/Private/Language/locallang_csh_tx_gbaccount_domain_model_transaction.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_gbaccount_domain_model_transaction');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_gbaccount_domain_model_payment');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_gbaccount_domain_model_payment_type');



// allow to list Transaction table records in Page mode
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_gbaccount_domain_model_transaction'][0] = array(
	'fList' => 'amount, user, partner, partner_order, is_on_hold, rejected',
	'icon' => TRUE
);
