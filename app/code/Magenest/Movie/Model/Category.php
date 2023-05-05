<?php

namespace Magenest\Movie\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'magenest_category';
    protected $_cacheTag = 'magenest_category';
    protected $_eventPrefix = 'magenest_category';


    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Category');
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

