<?php
namespace In2code\Powermail\Domain\Validator;

use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail;
use In2code\Powermail\Utility\ObjectUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Service\FlexFormService;
use TYPO3\CMS\Extbase\Service\TypoScriptService;
use TYPO3\CMS\Extbase\Validation\Exception\InvalidValidationOptionsException;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator as ExtbaseAbstractValidator;

/**
 * Class AbstractValidator
 */
abstract class AbstractValidator extends ExtbaseAbstractValidator implements ValidatorInterface
{

    /**
     * @var string
     */
    protected $variablesPrefix = 'tx_powermail_pi1';

    /**
     * Return variable
     *
     * @var bool
     */
    protected $validState = true;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @var array
     */
    protected $flexForm;

    /**
     * @var array
     */
    protected $configuration = [];

    /**
     * Set Error
     *
     * @param Field $field
     * @param string $label
     * @return void
     */
    public function setErrorAndMessage(Field $field, $label)
    {
        $this->setValidState(false);
        $this->addError($label, $field->getMarker());
    }

    /**
     * Check if javascript validation is activated
     *
     * @return bool
     */
    public function isServerValidationEnabled()
    {
        return $this->settings['validation']['server'] === '1';
    }

    /**
     * Get TypoScript and FlexForm
     *
     * @param ConfigurationManagerInterface $configurationManager
     * @return void
     */
    public function injectTypoScript(ConfigurationManagerInterface $configurationManager)
    {
        $typoScriptSetup = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
        );
        /** @var TypoScriptService $typoScriptService */
        $typoScriptService = ObjectUtility::getObjectManager()->get(TypoScriptService::class);
        $this->settings = $typoScriptService->convertTypoScriptArrayToPlainArray(
            $typoScriptSetup['plugin.']['tx_powermail.']['settings.']['setup.']
        );

        /** @var FlexFormService $flexFormService */
        $flexFormService = ObjectUtility::getObjectManager()->get(FlexFormService::class);
        $this->flexForm = $flexFormService->convertFlexFormContentToArray(
            $configurationManager->getContentObject()->data['pi_flexform']
        );
    }

    /**
     * Init
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * @param Mail $mail
     * @return bool
     */
    public function isValid($mail)
    {
        return true;
    }

    /**
     * @param boolean $validState
     * @return void
     */
    public function setValidState($validState)
    {
        $this->validState = $validState;
    }

    /**
     * @return boolean
     */
    public function isValidState()
    {
        return $this->validState;
    }

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param array $configuration
     * @return AbstractValidator
     */
    public function setConfiguration(array $configuration)
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * Validation should be in mostly workflows only on first action. This is createAction. But if confirmation is
     * turned on, validation should work in most cases on the confirmationAction.
     *
     * @return bool
     */
    public function isFirstActionForValidation()
    {
        $arguments = GeneralUtility::_GPmerged($this->variablesPrefix);
        if ($this->isConfirmationActivated()) {
            return $arguments['action'] === 'confirmation';
        } else {
            return $arguments['action'] === 'create';
        }
    }

    /**
     * Constructs the validator and sets validation options
     *
     * @param array $options Options for the validator
     * @throws InvalidValidationOptionsException
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    /**
     * @return bool
     */
    public function isConfirmationActivated()
    {
        return $this->flexForm['settings']['flexform']['main']['confirmation'] === '1';
    }
}
