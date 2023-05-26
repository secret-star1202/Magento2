<?php

namespace Magenest\Movie\Controller\Index;

use Magenest\Movie\Model\DirectorFactory;
use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory as DirectorCollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_pageFactory;
    protected $_directorFactory;

    protected $_directorCollectionFactory;
    public function __construct(Context $context, PageFactory $pageFactory, DirectorFactory $directorFactory, DirectorCollectionFactory $directorCollectionFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_directorFactory = $directorFactory;
        $this->_directorCollectionFactory = $directorCollectionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        // TODO: Implement execute() method.
//        $director = $this->_directorFactory->create();
        $director = $this->_directorCollectionFactory->create();
        $director->addFieldToFilter('director_id', ['gt' => 100]);
//        $director->addFieldToFilter('director_id', ['gt' => 0])->addFieldToFilter(
//            'name',
//            [
//                    ['like' => 'Liam%'],
//                    ['like' => 'Ryan%']
//            ]
//        );
        foreach ($director as $item) {
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
//        return $director->addFieldToFilter('id', ['gt' => 15]);
//        exit();
//        print_r(json_encode($director->getData()));
//        return $this->_pageFactory->create();
    }
}
