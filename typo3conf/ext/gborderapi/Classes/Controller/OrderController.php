<?php
namespace Gigabonus\Gborderapi\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
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
 * OrderController
 */
class OrderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * orderRepository
     * 
     * @var \Gigabonus\Gborderapi\Domain\Repository\OrderRepository
     * @inject
     */
    protected $orderRepository = NULL;


    /**
     * partnerRepository
     *
     * @var \Gigabonus\Gbpartner\Domain\Repository\PartnerRepository
     * @inject
     */
    protected $partnerRepository = NULL;


    /**
     * transactionRepository
     *
     * @var \Gigabonus\Gbaccount\Domain\Repository\TransactionRepository
     * @inject
     */
    protected $transactionRepository = NULL;

    
    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        
    }

    /**
     * action create
     *
     * @param \Gigabonus\Gborderapi\Domain\Model\Order $newOrder
     * @return string
     */
    public function createAction(\Gigabonus\Gborderapi\Domain\Model\Order $newOrder = NULL)
    {
        /**
         * @var \Gigabonus\Gborderapi\Domain\Model\Order $order
         */
        $order = $this->objectManager->get('Gigabonus\\Gborderapi\\Domain\\Model\\Order');

        $partnerId = GeneralUtility::_GET('partnerId');
        $orderId = GeneralUtility::_GET('orderid');
        $amount = GeneralUtility::_GET('amount');
        $status = GeneralUtility::_GET('status');
        $userId = GeneralUtility::_GET('userId');
        $currency = GeneralUtility::_GET('currency');
        $additionalData = GeneralUtility::_GET('data');
        $token = GeneralUtility::_GET('token');


        /** @var \Gigabonus\Gbpartner\Domain\Model\Partner $partner */
        $partner = $this->partnerRepository->findByUid($partnerId);
        $apiKey = $partner->getApiKey();

        if ($apiKey == $token) {
            $order->setPartnerId($partnerId);
            $order->setOrderid($orderId);
            $order->setAmount($amount);
            $order->setStatus($status);
            $order->setUserId($userId);
            $currency = ($currency == '' ? 'UAH' : $currency);
            $order->setCurrency($currency);
            $order->setData($additionalData);


            $partnerClassName = 'Gigabonus\\Gborderapi\\Partner\\' . $partner->getClassName();

            if (!class_exists($partnerClassName)) {
                throw new \Exception("Class doesn't exist");
            }

            /** @var \Gigabonus\Gborderapi\Partner\AbstractPartner $partnerClassObj */
            $partnerClassObj = GeneralUtility::makeInstance($partnerClassName);

            $fee = $partnerClassObj->calculateFee($amount);
            $bonus = $partnerClassObj->calculateBonus($amount);

            # DebuggerUtility::var_dump($amount . ' ' . $bonus . ' бонусов ');
            
            $order->setFee($fee);
            $this->orderRepository->add($order);

            /** @var \Gigabonus\Gbaccount\Domain\Model\Transaction $transaction */
            $transaction = $this->objectManager->get('Gigabonus\\Gbaccount\\Domain\\Model\\Transaction');

            $transaction->setAmount($bonus);
            $transaction->setPartner($partnerId);
            $transaction->setUser($userId);
            $transaction->setIsOnHold(true);

            $this->transactionRepository->add($transaction);

        }


        DebuggerUtility::var_dump($partner);
        DebuggerUtility::var_dump(GeneralUtility::_GET());
        return '';

        # $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        # $this->orderRepository->add($newOrder);
        # $this->redirect('list');
    }

}