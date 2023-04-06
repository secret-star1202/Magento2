<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends \Magenest\Movie\Controller\Adminhtml\Movie implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        \Magento\Framework\Registry                $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('movie_id');

        $model = $this->getRequest()->getParam('movie_id');
        $model = $this->_objectManager->create(\Magenest\Movie\Model\Movie::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(('This movie no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('magenest_movie_movie', $model);

        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Movie') : __('New Movie'),
            $id ? __('Edit Movie') : __('New Movie')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Movies'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTilte() : ('New Movie'));

        return $resultPage;
    }
}
