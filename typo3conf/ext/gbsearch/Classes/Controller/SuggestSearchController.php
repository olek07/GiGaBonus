<?php
namespace Gigabonus\Gbsearch\Controller;



use Gigabonus\Gbbase\Utility\Helpers\MainHelper;
use Gigabonus\Gbpartner\Domain\Model\Partner;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SuggestSearchController extends GeneralSearchController
{


    /**
     * action ajaxSearch
     */
    public function searchAction()
    {

        $term = GeneralUtility::_GET('term');

        $partners = $this->doSearch($term);

        $partnerList = [];

        /**
         * @var Partner $partner
         */
        foreach ($partners as $partner) {
            $partnerList[] = array('url' => MainHelper::getPartnerPageUrl($partner), 'value' => $partner->getName(), 'teaser' => $partner->getTeaser());
        }

        echo json_encode($partnerList);

        // echo '[{"uid":"17206","value":"\u0412\u0438\u043d\u043d\u0438\u043a\u0438 (\u0411\u0440\u0435\u0443\u0441\u0438\u0432\u0441\u044c\u043a\u0430), \u041a\u043e\u0437\u0435\u043b\u044c\u0449\u0438\u043d\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u041f\u043e\u043b\u0442\u0430\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"12906","value":"\u0412\u0438\u043d\u043d\u0438\u043a\u0438, \u0414\u0440\u043e\u0433\u043e\u0431\u044b\u0447\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u041b\u044c\u0432\u043e\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"23329","value":"\u0412\u0438\u043d\u043d\u0438\u043a\u0438, \u041d\u043e\u0432\u043e\u0432\u043e\u0434\u043e\u043b\u0430\u0436\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u0425\u0430\u0440\u044c\u043a\u043e\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"630","value":"\u0412\u0438\u043d\u043d\u0438\u043a\u043e\u0432\u0446\u044b, \u041b\u0438\u0442\u0438\u043d\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u0412\u0438\u043d\u043d\u0438\u0446\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"141","value":"\u0412\u0438\u043d\u043d\u0438\u0446\u0430"},{"uid":"22207","value":"\u0412\u0438\u043d\u043d\u0438\u0446\u043a\u0438\u0435 \u0418\u0432\u0430\u043d\u044b, \u0411\u043e\u0433\u043e\u0434\u0443\u0445\u043e\u0432\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u0425\u0430\u0440\u044c\u043a\u043e\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"10639","value":"\u0412\u0438\u043d\u043d\u0438\u0446\u043a\u0438\u0435 \u0421\u0442\u0430\u0432\u044b, \u0412\u0430\u0441\u0438\u043b\u044c\u043a\u043e\u0432\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u041a\u0438\u0435\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"146","value":"\u0412\u0438\u043d\u043d\u0438\u0446\u043a\u0438\u0435 \u0425\u0443\u0442\u043e\u0440\u0430, \u0412\u0438\u043d\u043d\u0438\u0446\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u0412\u0438\u043d\u043d\u0438\u0446\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"2284","value":"\u0412\u0438\u043d\u043d\u0438\u0446\u043a\u043e\u0435, \u0421\u0438\u043c\u0444\u0435\u0440\u043e\u043f\u043e\u043b\u044c\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u0410\u0420 \u041a\u0440\u044b\u043c"},{"uid":"6275","value":"\u0412\u0438\u043d\u043d\u0438\u0446\u043a\u043e\u0435, \u0428\u0430\u0445\u0442\u0435\u0440\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u0414\u043e\u043d\u0435\u0446\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"},{"uid":"13700","value":"\u0412\u0438\u043d\u043d\u0438\u0447\u043a\u0438, \u041f\u0443\u0441\u0442\u043e\u043c\u044b\u0442\u043e\u0432\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d, \u041b\u044c\u0432\u043e\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c"}]';
        exit;
    }


}