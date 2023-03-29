<?php

namespace Magenest\Movie\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Actor extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'magenest_actor';
    protected $_cacheTag = 'magenest_actor';
    protected $_eventPrefix = 'magenest_actor';


    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Actor');
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
