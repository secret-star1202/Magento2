<?php

namespace Magenest\Movie\Controller\Index;

use Magenest\Movie\Model\DirectorFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_pageFactory;
    protected $_directorFactory;

    public function __construct(Context $context, PageFactory $pageFactory, DirectorFactory $directorFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_directorFactory = $directorFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        $director = $this->_directorFactory->create();
        $collection = $director->getCollection();
        foreach ($collection as $item)
        {
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();
        return $this->_pageFactory->create();
    }
}
