<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class DefaultFirstNameCustomer implements ObserverInterface
{
    public function execute(EventObserver $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $customer->setData('firstname', 'Magenest');
    }
}
