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
    protected $coupon;
    protected $saleRule;
    protected $_salesRuleCollectionFactory;
    public function __construct(
        Template\Context                                              $context,
        Session                                                       $customerSession,
        Group                                                         $customerGroupCollection,
        Context                                                       $httpContext,
        \Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory $salesRuleCollectionFactory,
        array                                                         $data = []
    ) {
        $this->httpContext = $httpContext;
        $this->_customerSession = $customerSession;
        $this->_customerGroupCollection = $customerGroupCollection;
        $this->_salesRuleCollectionFactory = $salesRuleCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getCustomerGroup()
    {
        $isLogged = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $customerGroupId = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP);
        $groupCollection = $this->_customerGroupCollection->load($customerGroupId);
        return $groupCollection->getCustomerGroupCode();
    }

    public function getCustomerId()
    {
        $isLogged = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP);
    }

    public function getCouponCodes()
    {
        $isLogged = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $customerGroupId = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP);
        $_salesRulecollectionByCustomerGroup = $this->_salesRuleCollectionFactory->create()->addCustomerGroupFilter($customerGroupId);
        $result=$_salesRulecollectionByCustomerGroup->getData();
        return $result;
    }
}
