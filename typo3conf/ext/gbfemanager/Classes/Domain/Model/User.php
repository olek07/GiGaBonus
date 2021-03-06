<?php

namespace Gigabonus\Gbfemanager\Domain\Model;

class User extends \In2code\Femanager\Domain\Model\User {


    /**
     * gender
     *
     * @var string
     */
    protected $gender;

    /**
     * language
     *
     * @var string
     */
    protected $language;

    /**
     *
     * @var int
     */
    protected $cityId;
    
    /**
     *
     * @var \DateTime
     */
    protected $txGbfemanagerTelephonelastchanged;

    /**
     * @var int
     */
    protected $txGbfemanagerConfirmmailSentCount;

    /**
     * Sets the language
     *
     * @param string $language
     * @return User
     */
    public function setLanguage($language) {
        $this->language = $language;
        return $this;
    }

    /**
     * Returns the language
     *
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }
    
    /**
     * Sets the cityId
     *
     * @param int $cityid
     * @return User
     */
    public function setCityid($cityId) {
        $this->cityId = $cityId;
        return $this;
    }

    /**
     * Returns the cityId
     *
     * @return string
     */
    public function getCityId() {
        return $this->cityId;
    }

    
    /**
     * Sets the txGbfemanagerTelephonelastchanged
     *
     * @param int $txGbfemanagerTelephonelastchanged
     * @return User
     */
    public function setTxGbfemanagerTelephonelastchanged($txGbfemanagerTelephonelastchanged) {
        $this->txGbfemanagerTelephonelastchanged = $txGbfemanagerTelephonelastchanged;
        return $this;
    }

    /**
     * Returns the txGbfemanagerTelephonelastchanged
     *
     * @return string
     */
    public function getTxGbfemanagerTelephonelastchanged() {
        return $this->txGbfemanagerTelephonelastchanged;
    }

    /**
     * @return int
     */
    public function getTxGbfemanagerConfirmmailSentCount()
    {
        return $this->txGbfemanagerConfirmmailSentCount;
    }

    /**
     * @param int $txGbfemanagerConfirmmailSentCount
     */
    public function setTxGbfemanagerConfirmmailSentCount($txGbfemanagerConfirmmailSentCount)
    {
        $this->txGbfemanagerConfirmmailSentCount = $txGbfemanagerConfirmmailSentCount;
    }

    

}
