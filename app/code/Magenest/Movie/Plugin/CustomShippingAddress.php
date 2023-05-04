<?php

namespace Magenest\Movie\Plugin;

use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;

class CustomShippingAddress
{
    /**
     * @var MessageManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    public function __construct(
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magenest\Movie\Model\Region\Attribute\Source\Mode $option,
        MessageManagerInterface $messageManager
    ) {
        $this->option = $option;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $result)
    {
        $customAttributeCode = 'vn_region_id';
        $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
            'label' => 'VN Region',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ],
            'options' => $this->getOption(),
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'value' => '0' // value field is used to set a default value of the attribute
        ];

        $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;
        $configuration = $result['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'];
        foreach ($configuration as $paymentGroup => $groupConfig) {
            if (isset($groupConfig['component']) and $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {
                $result['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']['children']['custom_attribute_code'] = [
                    'component' => 'Magento_Ui/js/form/element/select',
                    'config' => [
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/select',
                        'id' => 'custom_attribute_id',
                    ],
                    'dataScope' => $groupConfig['dataScopePrefix'] . '.custom_attribute_id',
                    'label' => __('VN Region'),
                        'options' => $this->getOption(),
                    'provider' => 'checkoutProvider',
                    'visible' => true,
                    'validation' => [
                        'required-entry' => true,
                        'min_text_length' => 0,
                    ],
                    'sortOrder' => 300,
                    'id' => 'custom_attribute_id'
                ];
            }
        }
        return $result;
    }

    public function getOption()
    {
        return $this->option->getAllOptions();
    }
}
