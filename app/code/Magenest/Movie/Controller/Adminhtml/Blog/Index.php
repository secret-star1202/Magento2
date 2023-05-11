<?php

namespace Magenest\Movie\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magenest\Movie\Controller\Adminhtml\Blog implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);

    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend((__('Blogs')));
//
        $dataPersistor = $this->_objectManager->get(\Magento\Framework\App\Request\DataPersistorInterface::class);
        $dataPersistor->clear('magenest_movie_blog');
        return $resultPage;
//        echo "hello";
    }
}
