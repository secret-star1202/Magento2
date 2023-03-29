<?php

namespace Magenest\Movie\Model\ResourceModel\Movie;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'movie_id';
    protected $_eventPrefix = 'magenest_movie_movie_collection';
    protected $_eventObject = 'movie_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Movie', 'Magenest\Movie\Model\ResourceModel\Movie');
    }
}
