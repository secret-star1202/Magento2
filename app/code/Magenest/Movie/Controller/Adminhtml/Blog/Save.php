<?php

namespace Magenest\Movie\Controller\Adminhtml\Blog;

use Magenest\Movie\Model\BlogFactory;
use Magenest\Movie\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFatory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var UrlRewriteFactory
     */

    protected $_urlRewriteFactory;

    /**
     * @param UrlRewriteFactory $urlRewriteFactory
     */

    protected $blogFactory;
    protected $_blogCollectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        BlogFactory                         $blogFactory,
        BlogCollectionFatory                $blogCollectionFactory,
        UrlRewriteFactory                   $urlRewriteFactory
    ) {
        parent::__construct($context);
        $this->_urlRewriteFactory = $urlRewriteFactory;
        $this->blogFactory = $blogFactory;
        $this->_blogCollectionFactory = $blogCollectionFactory;
    }

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $urlRewrite = $this->_urlRewriteFactory->create();
//        $urlRewrite->setEntityType('custom');

        $urlRewrite->setStoreId(1);

        $collection = $this->_blogCollectionFactory->create();

        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();

        $model = $this->blogFactory->create();
        $url_rewrite = $data['url_rewrite'];
        $id = $data['id'];
        $collection->addFieldToFilter('url_rewrite', $url_rewrite)->addFieldToFilter('id', ['neq' => $id]);
        $id = $data['id'];
        if (!empty($data['id'])) {
            try {
                $model = $model->load($id);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            unset($data['id']);
        }

        if ($collection->getSize() > 0) {
            $this->messageManager->addErrorMessage(__('This url rewrite is exists.'));
//            return $resultRedirect->setPath('*/*/');
            return $this->resultRedirectFactory->create()->setRefererUrl();
        } else {
            $model->setData($data);
//            $model->save();
            $this->messageManager->addSuccessMessage(__('Save susscess.'));
//            $page = [
//                'entity_type' => 'view',
//                'entity_id' => $model->getData('id'),
//                'request_path' => $model->getData('url_rewrite'),
//                'target_path' => 'blog/edit/id/' . $model->getData('id'),
//                'store_id' => 1
//            ];

            $urlRewrite->setTargetPath('movie/blog/view/id/' . $model->getData('id'));
            $urlRewrite->setRequestPath($model->getData('url_rewrite'));

//            $urlRewrite->addData($editpage);
            $urlRewrite->save();

            return $this->resultRedirectFactory->create()->setPath('magenest_movie/blog/index');
        }
    }
}
