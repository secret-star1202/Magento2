<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Event\ObserverInterface;

class DefaultRatingMovie implements ObserverInterface
{
    protected $connection;
    public function __construct(ResourceConnection $resource)
    {
        $this->connection = $resource->getConnection();
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
//        $movie = $observer->getEvent()->getObject();
//        $movie->setData('rating', '0');
    }
}
