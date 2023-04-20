<?php

namespace Magenest\Movie\Block\Attributes;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Model\Customer;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Template\Context;

class Avatar extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var AbstractBlock
     */
    protected $viewFileUrl;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     *
     * @param Context $context
     * @param ObjectManagerInterface $objectManager
     * @param Repository $viewFileUrl
     * @param Customer $customer
     */
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        Repository $viewFileUrl,
        Customer $customer
    ) {
        $this->objectManager = $objectManager;
        $this->viewFileUrl = $viewFileUrl;
        $this->customer = $customer;
        parent::__construct($context);
    }

    /**
     * Check the file is already exist in the path.
     * @return boolean
     */
    public function checkImageFile($file)
    {
        $file = base64_decode($file);
        $filesystem = $this->objectManager->get('Magento\Framework\Filesystem');
        $directory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $fileName = CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER . '/' . ltrim($file, '/');
        $path = $directory->getAbsolutePath($fileName);
        if (!$directory->isFile($fileName)
            && !$this->objectManager->get('Magento\MediaStorage\Helper\File\Storage')->processStorageFile($path)
        ) {
            return false;
        }
        return true;
    }

    /**
     * Get the avatar of the customer is already logged in
     * @return string
     */
    public function getAvatarCurrentCustomer($file)
    {
        if ($this->checkImageFile(base64_encode($file)) === true) {
            return $this->getUrl('viewfile/avatar/view/', ['image' => base64_encode($file)]);
        }
        return $this->viewFileUrl->getUrl('Magenest_Movie::images/no-profile-photo.jpg');
    }

    /**
     * Get the avatar of the customer by the customer id
     * @return string
     */
    public function getCustomerAvatarById($customer_id = false)
    {
        if ($customer_id) {
            $customerDetail = $this->customer->load($customer_id);
            if ($customerDetail && !empty($customerDetail->getProfilePicture())) {
                if ($this->checkImageFile(base64_encode($customerDetail->getProfilePicture())) === true) {
                    return $this->getUrl('viewfile/avatar/view/', ['image' => base64_encode($customerDetail->getProfilePicture())]);
                }
            }
        }
        return $this->viewFileUrl->getUrl('Magenest_Movie::images/no-profile-photo.jpg');
    }
}
