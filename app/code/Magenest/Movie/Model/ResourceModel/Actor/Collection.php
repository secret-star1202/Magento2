<?php

namespace Magenest\Movie\Model\ResourceModel\Actor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'actor_id';
    protected $_eventPrefix = 'magenest_movie_actor_collection';
    protected $_eventObject = 'actor_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\Actor', 'Magenest\Movie\Model\ResourceModel\Actor');
    }
}
