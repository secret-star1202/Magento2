<?php

namespace Magenest\Movie\Model\ResourceModel\Director;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'director_id';
    protected $_eventPrefix = 'magenest_movie_director_collection';
    protected $_eventObject = 'director_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\Director', 'Magenest\Movie\Model\ResourceModel\Director');
    }
}
