<?php

namespace Magenest\Movie\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
class Director extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'magenest_director';
    protected $_cacheTag = 'magenest_director';
    protected $_eventPrefix = 'magenest_director';


    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Director');
    }

    public function getIdentities()
    {
        // TODO: Implement getIdentities() method.
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $value = [];
        return $value;
    }
}
