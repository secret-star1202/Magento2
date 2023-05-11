<?php

namespace Magenest\Movie\Model\Api;

use Magenest\Movie\Api\BlogRepositoryInterface;
use Magenest\Movie\Model\BlogFactory;
use Magenest\Movie\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Magento\Framework\Webapi\Rest\Request;
use Magento\UrlRewrite\Model\UrlRewriteFactory;

class Blog implements BlogRepositoryInterface
{

    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    private $dateTime;

    /**
     * @var UrlRewriteFactory
     */
    protected $_urlRewriteFactory;
    protected $blogFactory;
    protected $_blogCollectionFactory;
    protected $response = ['success' => false];
    /**
     * @var Request
     */
    protected $request;
    private $quote;

    public function __construct(
        BlogFactory                $blogFactory,
        \Magento\Quote\Model\Quote $quote,
        BlogCollectionFactory      $blogCollectionFactory,
        Request                    $request,
        UrlRewriteFactory $urlRewriteFactory,
        \Magento\Framework\Stdlib\DateTime $dateTime,
    ) {
        $this->quote = $quote;
        $this->blogFactory = $blogFactory;
        $this->_blogCollectionFactory = $blogCollectionFactory;
        $this->request = $request;
        $this->_urlRewriteFactory = $urlRewriteFactory;
        $this->dateTime = $dateTime;
    }

    public function getById($id)
    {
        try {
            if ($id) {
                $data = $this->blogFactory->create()->load($id)->getData();
                return ['success' => true, 'message' => $data];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getList()
    {
        // TODO: Implement getData() method.
        try {
            $data = $this->_blogCollectionFactory->create()->getData();
            return $data;
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
//        return "Hello";
    }

    public function delete($id)
    {
        // TODO: Implement getDelete() method.
        try {
            if ($id) {
                $data = $this->blogFactory->create()->load($id);
                $data->delete();
                return "Delete success";
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return "Delete false";
    }

    public function add()
    {
        $data = [
            'author_id' => $this->request->getPost('author_id'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'url_rewrite' => $this->request->getPost('url_rewrite'),
            'rating' => $this->request->getPost('rating'),
            'status' => $this->request->getPost('status'),
            'create_at' => $this->dateTime->formatDate(true),
            'update_at' => $this->dateTime->formatDate(true)

        ];

        $create = $this->blogFactory->create();
        $create->setData($data);
        $create->save();
        return [ 'message' => 'success', 'data' =>$data];
        //        return $this->request->getBodyParams();
    }

    public function update($id)
    {
        try {
            $post = $this->blogFactory->create()->load($id);

            if ($post->getId()) {
                $data = array_merge(
                    $post->getData(),
                    [
                        'author_id' => $this->request->getPost('author_id'),
                        'title' => $this->request->getPost('title'),
                        'description' => $this->request->getPost('description'),
                        'content' => $this->request->getPost('content'),
                        'url_rewrite' => $this->request->getPost('url_rewrite'),
                        'rating' => $this->request->getPost('rating'),
                        'status' => $this->request->getPost('status'),
                        'updated_at' => $this->dateTime->formatDate(true)
                    ]
                );

//                $data = $this->_filterPostData($data);

                $post->setData($data);
                $post->save();

                return ['success' => true, 'message' => 'Blog post updated successfully'];
            } else {
                return ['success' => false, 'message' => 'Blog post not found'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
