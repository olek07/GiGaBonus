<?php
namespace Gigabonus\Gbfelogin\Xclass;

use Gigabonus\Gbbase\Utility\Helpers\MainHelper;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class FrontendLoginController extends \TYPO3\CMS\Felogin\Controller\FrontendLoginController {
    
    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;


    /**
     * The main method of the plugin
     *
     * @param string $content The PlugIn content
     * @param array $conf The PlugIn configuration
     * @return string The content that is displayed on the website
     */
    public function main($content, $conf)
    {

        $content = parent::main($content, $conf);

        $content = str_replace('###ENTERED_EMAIL###', htmlspecialchars(GeneralUtility::_GP('user'), ENT_COMPAT, 'UTF-8', FALSE), $content);


        // if login box is called via AJAX
        if ($_GET['type'] == 103) {

            $linkConf = array(
                'parameter' => MainHelper::LOGINPAGEID,
                'additionalParams' => '&L=' . $GLOBALS['TSFE']->sys_language_uid . '&' .$this->prefixId . '[forgot]=1',
                # 'returnLast' => 'url'
            );

            $content = str_replace('###LINK_FORGOT_PASSWORD###', $this->cObj->typoLink($this->pi_getLL('ll_forgot_header', '', true), $linkConf), $content);


            $jsonObj = new \stdClass();

            if ($GLOBALS['TSFE']->fe_user->user !== NULL) {
                $jsonObj->loggedIn = true;
            }
            else {
                $jsonObj->loggedIn = false;
            }

            $jsonObj->content = $content;

            $jsonObj->dashboardUrl = MainHelper::getDashboardPageUrl();

            $content = json_encode($jsonObj);
        }

        return $content;
    }


    /**
     * Shows the forgot password form
     *
     * @return string Content
     */
    protected function showForgot() {
        if ($GLOBALS['TSFE']->fe_user->user !== NULL) {
            MainHelper::redirect2ChangePasswordPage();
            exit;
        }
        return parent::showForgot();
    }


    /**
     * Generates a hashed link and send it with email
     *
     * @param array $user Contains user data
     * @return string Empty string with success, error message with no success
     */
    protected function generateAndSendHash($user)
    {
        $hours = (int)$this->conf['forgotLinkHashValidTime'] > 0 ? (int)$this->conf['forgotLinkHashValidTime'] : 24;
        $validEnd = time() + 3600 * $hours;
        $hash = md5(GeneralUtility::generateRandomBytes(64));
        $randHash = $validEnd . '|' . $hash;
        $randHashDB = $validEnd . '|' . md5($hash);
        // Write hash to DB
        $res = $this->databaseConnection->exec_UPDATEquery('fe_users', 'uid=' . $user['uid'], array('felogin_forgotHash' => $randHashDB));
        // Send hashlink to user
        $this->conf['linkPrefix'] = -1;
        $isAbsRefPrefix = !empty($this->frontendController->absRefPrefix);
        $isBaseURL = !empty($this->frontendController->baseUrl);
        $isFeloginBaseURL = !empty($this->conf['feloginBaseURL']);
        $link = $this->pi_getPageLink($this->conf['restorePasswordPageUid'], '', array(
            rawurlencode('tx_femanager_pi1[forgothash]') => $randHash,
            'L' => GeneralUtility::_GET('L')
        ));
        
        // Prefix link if necessary
        if ($isFeloginBaseURL) {
            // First priority, use specific base URL
            // "absRefPrefix" must be removed first, otherwise URL will be prepended twice
            if ($isAbsRefPrefix) {
                $link = substr($link, strlen($this->frontendController->absRefPrefix));
            }
            $link = $this->conf['feloginBaseURL'] . $link;
        } elseif ($isAbsRefPrefix) {
            // Second priority
            // absRefPrefix must not necessarily contain a hostname and URL scheme, so add it if needed
            $link = GeneralUtility::locationHeaderUrl($link);
        } elseif ($isBaseURL) {
            // Third priority
            // Add the global base URL to the link
            $link = $this->frontendController->baseUrlWrap($link);
        } else {
            // No prefix is set, return the error
            return $this->pi_getLL('ll_change_password_nolinkprefix_message');
        }

        $firstName = '';

        // read the user's firstname
        $res = $this->databaseConnection->exec_SELECTquery(
            'first_name',
            'fe_users',
            'email="' . $user['email'] . '"'
        );
        if ($this->databaseConnection->sql_num_rows($res)) {
            $row = $this->databaseConnection->sql_fetch_assoc($res);
            if (isset($row['first_name'])) {
                $firstName = $row['first_name'];
            }
        }

        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($row);exit;
                
            $this->sendTemplateEmail([$user['email']], ['samoglavny@mail.ru'], 'GigaBonus.ua | Восстановление пароля', 'ResetPassword', ['name' => $firstName, 'link' => $link, 'hours' => $hours]);

        return '';
    }
    
    
    /**
    * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
    * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
    * @param string $subject subject of the email
    * @param string $templateName template name (UpperCamelCase)
    * @param array $variables variables to be passed to the Fluid view
    * @return boolean TRUE on success, otherwise false
    */
    protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {

        $this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
        $emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $templatePathAndFilename =  'typo3conf/ext/gbfelogin/Resources/Private/Templates/Email/' . $templateName . '.html';

        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);


            // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($emailBody);

        /** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
        $message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $message->setTo($recipient)
              ->setFrom($sender)
              ->setSubject($subject);

        // $cid = $message->embed(\Swift_Image::fromPath('c:\\tmp\\rubl.gif'));

        // Possible attachments here
        //foreach ($attachments as $attachment) {
        	// $message->attach(\Swift_Attachment::fromPath('c:\\tmp\\rubl.gif'));
        //}


        $emailView->assign('cid', $cid);
        
        $emailBody = $emailView->render();

        // Plain text example
        // $message->setBody('plain text', 'text/plain');

        // HTML Email
        $message->setBody($emailBody, 'text/html');

        $message->send();
        return $message->isSent();
    }

}
