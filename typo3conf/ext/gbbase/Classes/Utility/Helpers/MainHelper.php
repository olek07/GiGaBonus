<?php
namespace Gigabonus\Gbbase\Utility\Helpers;

use TYPO3\CMS\Core\Utility\HttpUtility;

class MainHelper {
    
    const LOGINPAGEID = 3;
    const REGISTRATIONPAGEUID = 4;
    const CHANGEPASSWORDPAGEID = 8;
    const CHANGEUSERDATAPAGEID = 6;
    const TRANSACTIONLISTPAGEUID = 14;
    const DELETEPROFILEPAGEID = 16;
    const PARTNERDETAILPAGEID = 17;
    const CONTACTPAGEID = 24;
    const DASHBOARDPAGEID = 23;

    public static function redirect2Home() {
        $url = $GLOBALS['TSFE']->cObj->typoLink_URL(
            array(
                'parameter' => 1,
                // 'forceAbsoluteUrl' => true,
            )
        );
        HttpUtility::redirect($url);
    }
    
    public static function redirect2DeleteProfilePage() {
        $url = $GLOBALS['TSFE']->cObj->typoLink_URL(
            array(
                'parameter' => self::DELETEPROFILEPAGEID,
            )
        );
        HttpUtility::redirect($url);
        
    }

    public static function redirect2ChangePasswordPage() {
        self::redirect2Page(self::CHANGEPASSWORDPAGEID);
    }

    
    public static function getDashboardPageUrl() {
        $url = $GLOBALS['TSFE']->cObj->typoLink_URL(
            array(
                'parameter' => self::DASHBOARDPAGEID,
            )
        );
        
        return $url;
    }
    
    public static function redirect2Page($pageId) {
        $url = $GLOBALS['TSFE']->cObj->typoLink_URL(
            array(
                'parameter' => $pageId,
            )
        );
        HttpUtility::redirect($url);
    }

    public static function setTitleTag($title) {
        $GLOBALS['TSFE']->page['title'] = $title;
    }

    /**
     * returns the url to tha partner page
     *
     *
     * @param \Gigabonus\Gbpartner\Domain\Model\Partner $partner
     * @param \Gigabonus\Gbpartner\Domain\Model\Category|NULL $category
     * @return mixed
     */
    public static function getPartnerPageUrl(\Gigabonus\Gbpartner\Domain\Model\Partner $partner, \Gigabonus\Gbpartner\Domain\Model\Category $category = NULL) {

        if ($category !== NULL) {
            $mainCategory = $category->getUid();
        }
        else {
            // if no main category defined, take the first category as main category
            $mainCategory = $partner->getMainCategory();
            if ($mainCategory == 0) {
                /**
                 * @var \Gigabonus\Gbpartner\Domain\Model\Category $category
                 */
                $category = $partner->getCategory()->toArray()[0];
                $mainCategory = $category->getUid();
            }
        }

        $url = $GLOBALS['TSFE']->cObj->typoLink_URL(
            array(
                'parameter' => self::PARTNERDETAILPAGEID,
                'additionalParams' => '&tx_gbpartner_partnerlisting[action]=show&tx_gbpartner_partnerlisting[category]='
                    . $mainCategory . '&tx_gbpartner_partnerlisting[controller]=Partner&tx_gbpartner_partnerlisting[partner]='
                    . $partner->getUid()
            )
        );
        
        return $url;
    }


    /* ARRAY ID TO LANGUAGES WITH 2 LETTERS */

    public static $langIds = array(
        0   => 'ru',
        1   => 'uk',
    );

    public static $titleSuffix = array(
        'ru' => 'Кэшбэк-система GigaBonus',
        'uk' => 'Кешбек-система GigaBonus'
    );


}