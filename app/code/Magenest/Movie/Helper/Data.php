<?php

namespace Magenest\Movie\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_MOVIE = 'movie/';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_MOVIE . 'general/' . $code, $storeId);
    }

    /**
     * Buynow button title path
     */
    const BUYNOW_BUTTON_TITLE_PATH = 'buynow/general/button_title';

    /**
     * Buynow button title
     */
    const BUYNOW_BUTTON_TITLE = 'Buy Now';

    /**
     * Addtocart button form id path
     */
    const ADDTOCART_FORM_ID_PATH = 'movie/general/addtocart_id';

    /**
     * Addtocart button form id
     */
    const ADDTOCART_FORM_ID = 'product_addtocart_form';

    /**
     * Keep cart products path
     */
    const KEEP_CART_PRODUCTS_PATH = 'movie/general/keep_cart_products';

    /**
     * Retrieve config value
     *
     * @return string
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get button title
     * @return string
     */
    public function getButtonTitle()
    {
        $btnTitle = $this->getConfig(self::BUYNOW_BUTTON_TITLE_PATH);
        return $btnTitle ? $btnTitle : self::BUYNOW_BUTTON_TITLE;
    }

    /**
     * Get addtocart form id
     * @return string
     */
    public function getAddToCartFormId()
    {
        $addToCartFormId = $this->getConfig(self::ADDTOCART_FORM_ID_PATH);
        return $addToCartFormId ? $addToCartFormId : self::ADDTOCART_FORM_ID;
    }

    /**
     * Check if keep cart products
     * @return string
     */
    public function keepCartProducts()
    {
        return $this->getConfig(self::KEEP_CART_PRODUCTS_PATH);
    }
}
