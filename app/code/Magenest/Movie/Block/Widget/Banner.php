<?php

namespace Magenest\Movie\Block\Widget;

use Magento\Customer\Model\Group;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Http\Context;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    protected $_template = "widget/banner.phtml";
    protected $_customerSession;

    protected $httpContext;
    protected $_customerGroupCollection;

    public function __construct(Template\Context $context, Session $customerSession, Group $customerGroupCollection, Context $httpContext, array $data = [])
    {
        $this->httpContext = $httpContext;
        $this->_customerSession = $customerSession;
        $this->_customerGroupCollection = $customerGroupCollection;
        parent::__construct($context, $data);
    }

    public function getCustomerGroup()
    {
        $isLogged = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $customerGroupId = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP);
        $groupCollection = $this->_customerGroupCollection->load($customerGroupId);
        return $groupCollection->getCustomerGroupCode();

    }
}
