<?php

namespace Magenest\Movie\Block\View;

use Magenest\Movie\Model\BlogFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * Request instance
     *
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;
    protected $blogFactory;
    protected $userFactory;

    public function __construct(
        Template\Context                $context,
        BlogFactory                     $blogFactory,
        \Magento\User\Model\UserFactory $userFactory,
        RequestInterface                $request,
        array                           $data = []
    ) {
        $this->blogFactory = $blogFactory;
        $this->userFactory = $userFactory;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getInfoBlog()
    {
        $blogId = $this->request->getParam("id");
        $data = $this->blogFactory->create()->load($blogId)->getData();

        if ($data != null) {
            return $data;
        }
        return null;
    }
}
