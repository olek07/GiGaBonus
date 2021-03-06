<?php
namespace Gigabonus\Gblanguages\Controller;

use Gigabonus\Gbbase\Utility\Helpers\MainHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Alexander Averbuch <alav@gmx.net>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * CategoryController
 */
class MenuController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{


    /**
     * pageRepository
     *
     * @var \TYPO3\CMS\Frontend\Page\PageRepository
     * @inject
     */
    protected $pageRepository;

    /**
     * action show
     * @return void
     */
    public function showAction() {


        $languageItems = GeneralUtility::intExplode(',', $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_gblanguages.']['availableLanguages']);

        // pids and get-parameters to add to the link in the language switch
        $enabledParameters = array(
            3  => array('tx_felogin_pi1|forgot', 'tx_felogin_pi1|controller'),
            17 => array('tx_gbpartner_partnerlisting|category', 'tx_gbpartner_partnerlisting|partner'),
        );

        $pageUid = $GLOBALS['TSFE']->page['uid'];

        $queryStringArr = array();

        if (isset($enabledParameters[$pageUid])) {
            foreach ($enabledParameters[$pageUid] as $enabledParameter) {

                $p = explode('|', $enabledParameter);

                if (is_array($_GET[$p[0]])) {
                    $queryStringArr[$p[0]][$p[1]] = $_GET[$p[0]][$p[1]];
                } else {
                    $queryStringArr[$p[0]] = $_GET[$p[0]];
                }
            }
        }

        $qs = http_build_query($queryStringArr);

/*
        if (!isset($_GET['cHash'])) {
            $GLOBALS['TSFE']->set_no_cache("don't cache this page");
        }
*/

        $languagesLinks = array();

        if (!is_array($languageItems)) {
           return;
        }

        foreach ($languageItems as $i) {

            if ($i != 0) {
                // Wenn keine Lokalisierung für die Seite existiert oder auf hidden gesetzt, kein Link generieren
                $pageOverlay = $this->pageRepository->getPageOverlay($GLOBALS['TSFE']->page['uid'], 1);
                if (is_array($pageOverlay) && count($pageOverlay) == 0) {
                    break;
                }
            }
            
            $languagesLinks[$i] = $GLOBALS['TSFE']->cObj->typolink_url(
                array(
                    'parameter' => $GLOBALS['TSFE']->page['uid'],
                    'additionalParams' => '&L=' . $i . '&' . $qs,
                    'useCacheHash' => true,
                )
            );
        }

        $this->view->assign('languagesLinks', $languagesLinks);
        $this->view->assign('currentLanguage', GeneralUtility::_GET('L'));

    }

}