<?php

namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory = false;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
//        $resultPage->setActiveMenu('Magenest_Movie::magenest_actor');
        $resultPage->getConfig()->getTitle()->prepend((__('Actor')));

        return $resultPage;
    }
}
