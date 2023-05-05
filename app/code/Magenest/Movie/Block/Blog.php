<?php

namespace Magenest\Movie\Block;

use Magenest\Movie\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Magento\Framework\View\Element\Template;

class Blog extends Template
{
    protected $_blogCollectionFactory;
    protected $_resource;

    public function __construct(
        Template\Context                          $context,
        BlogCollectionFactory                     $blogCollectionFactory,
        \Magento\Framework\App\ResourceConnection $Resource,
    ) {
        $this->_blogCollectionFactory = $blogCollectionFactory;
        $this->_resource = $Resource;

        parent::__construct($context);
    }

//    protected function _prepareLayout()
//    {
//        $text = $this->getBlogCollection();
//        $this->setText($text);
//    }

    public function getBlogCollection()
    {
        $collection = $this->_blogCollectionFactory->create();
//        return $collection->addFieldToSelect('*')->setPageSize(10);
        $admin_user = $this->_resource->getTableName('admin_user');

        $collection->getSelect()->joinLeft(
            ['second' => $admin_user],
            'main_table.author_id = second.user_id',
            ['admin_user_username' => 'second.username', 'admin_user_email' => 'second.email' ]
        );
        return $collection->addFieldToSelect('*')->setPageSize(10);
    }
}
