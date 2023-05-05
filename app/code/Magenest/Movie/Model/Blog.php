<?php

namespace Magenest\Movie\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Blog extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'magenest_blog';
    protected $_cacheTag = 'magenest_blog';
    protected $_eventPrefix = 'magenest_blog';


    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Blog');
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
