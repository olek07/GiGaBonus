<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:gbaccount/Resources/Private/Language/locallang_db.xlf:tx_gbaccount_domain_model_transaction',
		'label' => 'amount',
		// 'label_alt' => 'user',
		// 'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		// 'sortby' => 'crdate',
		'default_sortby' => 'ORDER BY crdate DESC',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'amount, partner, user',
		'iconfile' => 'EXT:gbaccount/Resources/Public/Icons/tx_gbaccount_domain_model_transaction.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, user, crdate, amount, saldo, partner, is_on_hold, rejected',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,--palette--;;1,user,crdate,amount,saldo,partner,is_on_hold,rejected,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,starttime,endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
/*	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
*/
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_gbaccount_domain_model_transaction',
				'foreign_table_where' => 'AND tx_gbaccount_domain_model_transaction.pid=###CURRENT_PID### AND tx_gbaccount_domain_model_transaction.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),


		'crdate' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'Created',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
/*
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
*/
			),

		),

		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'amount' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:gbaccount/Resources/Private/Language/locallang_db.xlf:tx_gbaccount_domain_model_transaction.amount',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),

		'partner_order' => array(
			'exclude' => 0,
			'label' => 'Order Id',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),

		'saldo' => array(
			'exclude' => 0,
			'label' => 'Saldo',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),

		'user' => array(
			'exclude' => 0,
			'label' => 'User',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'partner' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:gbaccount/Resources/Private/Language/locallang_db.xlf:tx_gbaccount_domain_model_transaction.partner',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_gbpartner_domain_model_partner',
                'foreign_table_where' => ' AND tx_gbpartner_domain_model_partner.sys_language_uid IN (-1, 0) ',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
            
        'is_on_hold' => array(
			'exclude' => 0,
			'label' => 'On hold?',
			'config' => array(
				'type' => 'check',
				'size' => 4,
			)
		),

		'rejected' => array(
			'exclude' => 0,
			'label' => 'Rejected?',
			'config' => array(
				'type' => 'check',
			)
		),

		'status' => array(
			'exclude' => 0,
			'label' => 'Status',
			'config' => array(
				'type' => 'input',
				'size' => 1,
				'eval' => 'int'
			)
		),

            
	),
);