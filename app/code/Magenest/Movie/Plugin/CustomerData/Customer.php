<?php

namespace Magenest\Movie\Plugin\CustomerData;

use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Helper\View;
use Magenest\Movie\Block\Attributes\Avatar;

class Customer
{
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var View
     */
    protected $customerViewHelper;

    /**
     * @var Avatar
     */
    protected $customerAvatar;

    /**
     * @param CurrentCustomer $currentCustomer
     * @param View $customerViewHelper
     * @param Avatar $customerAvatar
     */
    public function __construct(
        CurrentCustomer $currentCustomer,
        View $customerViewHelper,
        Avatar $customerAvatar
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->customerViewHelper = $customerViewHelper;
        $this->customerAvatar = $customerAvatar;
    }

    /**
     * {@inheritdoc}
     */
    public function afterGetSectionData()
    {
        if (!$this->currentCustomer->getCustomerId()) {
            return [];
        }
        $customer = $this->currentCustomer->getCustomer();
        if (!empty($customer->getCustomAttribute('profile_picture'))) {
            $file = $customer->getCustomAttribute('profile_picture')->getValue();
        } else {
            $file = '';
        }
        return [
            'fullname' => $this->customerViewHelper->getCustomerName($customer),
            'firstname' => $customer->getFirstname(),
            'avatar' => $this->customerAvatar->getAvatarCurrentCustomer($file)
        ];
    }
}
