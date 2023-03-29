<?php

namespace Magenest\Movie\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Movie extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'magenest_movie';
    protected $_cacheTag = 'magenest_movie';
    protected $_eventPrefix = 'magenest_movie';

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
