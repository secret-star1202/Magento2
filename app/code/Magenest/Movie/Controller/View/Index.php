<?php

namespace Magenest\Movie\Controller\View;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // Get the ID parameter from the URL
        $id = $this->getRequest()->getParam('id');

        // Do something with the ID parameter

        // Render the output
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
