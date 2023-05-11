<?php

namespace Magenest\Movie\Controller\Adminhtml\Blog;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends \Magenest\Movie\Controller\Adminhtml\Blog implements HttpGetActionInterface
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
        $id = $this->getRequest()->getParam('id');
        $model = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Magenest\Movie\Model\Blog::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(('This blog no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('magenest_movie_blog', $model);

        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Blog') : __('New Blog'),
            $id ? __('Edit Blog') : __('New Blog')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Blogs'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTilte() : ('New Blog'));

        return $resultPage;
    }
}
