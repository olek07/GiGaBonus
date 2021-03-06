<?php
return [
    'BE' => [
        'debug' => true,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$P$CR1lmJLB41ieCST1bY7ptE6eH0bIIp1',
        'loginSecurityLevel' => 'rsa',
        'versionNumberInFilename' => '0',
    ],
    'DB' => [
        'database' => 'gigabonus',
        'host' => 'localhost',
        'password' => '',
        'socket' => '/opt/lampp/var/mysql/mysql.sock',
        'username' => 'root',
    ],
    'EXT' => [
        'extConf' => [
            'femanager' => 'a:2:{s:13:"disableModule";s:1:"0";s:10:"disableLog";s:1:"0";}',
            'gbaccount' => 'a:0:{}',
            'gbbase' => 'a:0:{}',
            'gbfelogin' => 'a:0:{}',
            'gbfemanager' => 'a:0:{}',
            'gblanguages' => 'a:0:{}',
            'gborderapi' => 'a:0:{}',
            'gbpartner' => 'a:0:{}',
            'gbredirect' => 'a:0:{}',
            'gbsearch' => 'a:0:{}',
            'gbtools' => 'a:0:{}',
            'powermail' => 'a:8:{s:12:"disableIpLog";s:1:"0";s:27:"disableMarketingInformation";s:1:"0";s:20:"disableBackendModule";s:1:"0";s:24:"disablePluginInformation";s:1:"0";s:35:"disablePluginInformationMailPreview";s:1:"0";s:13:"enableCaching";s:1:"0";s:15:"l10n_mode_merge";s:1:"0";s:29:"replaceIrreWithElementBrowser";s:1:"0";}',
            'realurl' => 'a:6:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"1";s:14:"autoConfFormat";s:1:"0";s:17:"segTitleFieldList";s:0:"";s:12:"enableDevLog";s:1:"0";s:10:"moduleIcon";s:1:"0";}',
            'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
            'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
            'scheduler' => 'a:4:{s:11:"maxLifetime";s:4:"1440";s:11:"enableBELog";s:1:"1";s:15:"showSampleTasks";s:1:"1";s:11:"useAtdaemon";s:1:"0";}',
            'sr_freecap' => 'a:1:{s:19:"encryptionAlgorithm";s:8:"blowfish";}',
        ],
    ],
    'EXTCONF' => [
        'lang' => [
            'availableLanguages' => [
                'ru',
                'uk',
            ],
        ],
    ],
    'FE' => [
        'cHashIncludePageId' => '1',
        'compressionLevel' => '0',
        'debug' => true,
        'lifetime' => '31536000',
        'lockIP' => '0',
        'loginSecurityLevel' => 'normal',
        'pageNotFound_handling' => 'USER_FUNCTION:EXT:gbredirect/Classes/Services/PageNotFoundService.php:Gigabonus\\Gbredirect\\Services\\PageNotFoundService->pageNotFound',
        'pageUnavailable_force' => '0',
    ],
    'GFX' => [
        'colorspace' => 'sRGB',
        'im' => 1,
        'im_mask_temp_ext_gif' => 1,
        'im_path' => '/usr/bin/',
        'im_path_lzw' => '/usr/bin/',
        'im_v5effects' => 1,
        'im_version_5' => 'im6',
        'image_processing' => 1,
        'jpg_quality' => '80',
    ],
    'HTTP' => [
        'adapter' => 'curl',
    ],
    'INSTALL' => [
        'wizardDone' => [
            'TYPO3\CMS\Install\Updates\AccessRightParametersUpdate' => 1,
            'TYPO3\CMS\Install\Updates\BackendUserStartModuleUpdate' => 1,
            'TYPO3\CMS\Install\Updates\Compatibility6ExtractionUpdate' => 1,
            'TYPO3\CMS\Install\Updates\ContentTypesToTextMediaUpdate' => 1,
            'TYPO3\CMS\Install\Updates\FileListIsStartModuleUpdate' => 1,
            'TYPO3\CMS\Install\Updates\FilesReplacePermissionUpdate' => 1,
            'TYPO3\CMS\Install\Updates\LanguageIsoCodeUpdate' => 1,
            'TYPO3\CMS\Install\Updates\MediaceExtractionUpdate' => 1,
            'TYPO3\CMS\Install\Updates\MigrateMediaToAssetsForTextMediaCe' => 1,
            'TYPO3\CMS\Install\Updates\MigrateShortcutUrlsAgainUpdate' => 1,
            'TYPO3\CMS\Install\Updates\OpenidExtractionUpdate' => 1,
            'TYPO3\CMS\Install\Updates\PageShortcutParentUpdate' => 1,
            'TYPO3\CMS\Install\Updates\ProcessedFileChecksumUpdate' => 1,
            'TYPO3\CMS\Install\Updates\TableFlexFormToTtContentFieldsUpdate' => 1,
            'TYPO3\CMS\Install\Updates\WorkspacesNotificationSettingsUpdate' => 1,
            'TYPO3\CMS\Rtehtmlarea\Hook\Install\DeprecatedRteProperties' => 1,
            'TYPO3\CMS\Rtehtmlarea\Hook\Install\RteAcronymButtonRenamedToAbbreviation' => 1,
        ],
    ],
    'MAIL' => [
        'defaultMailFromAddress' => 'samoglavny@mail.ru',
        'defaultMailFromName' => 'Alexander',
        'transport' => 'mbox',
        'transport_mbox_file' => '/opt/lampp/htdocs/gigabonus/mail',
        'transport_sendmail_command' => '',
        'transport_smtp_encrypt' => 'ssl',
        'transport_smtp_password' => 'Wissen123',
        'transport_smtp_server' => 'smtp.mail.ru:465',
        'transport_smtp_username' => 'samoglavny@mail.ru',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'extbase_object' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
                    'groups' => [
                        'system',
                    ],
                    'options' => [
                        'defaultLifetime' => 0,
                    ],
                ],
            ],
        ],
        'clearCacheSystem' => true,
        'curlUse' => '1',
        'devIPmask' => '*',
        'displayErrors' => 1,
        'enableDeprecationLog' => 'file',
        'encryptionKey' => 'c125ff9bb415de0bfcea17bba3e6cf385f26d21d6b38aa4bf4942276d0b5aa2779379d77d8467f4234717d39e9b820ea',
        'exceptionalErrors' => 28674,
        'isInitialDatabaseImportDone' => true,
        'isInitialInstallationInProgress' => false,
        'phpTimeZone' => 'Europe/Berlin',
        'sitename' => 'GigaBonus',
        'sqlDebug' => 1,
        'systemLogLevel' => 0,
        't3lib_cs_convMethod' => 'mbstring',
        't3lib_cs_utils' => 'mbstring',
    ],
];
