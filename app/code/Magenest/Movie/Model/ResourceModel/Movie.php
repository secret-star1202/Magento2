<?php

namespace Magenest\Movie\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Movie extends AbstractDb
{
    const NAME_TABLE = 'magenest_movie';
    const ID = 'movie_id';
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::NAME_TABLE, self::ID);
    }
}
