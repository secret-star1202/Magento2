<?php

namespace Magenest\Movie\Controller\Index;


//use Magenest\Movie\Model\BlogFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Blog extends Action
{
    protected $_pageFactory;
//    protected $_blogFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
//        $this->_blogFactory = $blogFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
//        // TODO: Implement execute() method.
//        $director = $this->_blogFactory->create();
//        $collection = $director->getCollection();
//        foreach ($collection as $item) {
//            echo "<pre>";
//            print_r($item->getData());
//            echo "</pre>";
//        }
//        exit();
        return $this->_pageFactory->create();
    }
}

