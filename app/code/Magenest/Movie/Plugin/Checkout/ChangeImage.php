<?php

namespace Magenest\Movie\Plugin\Checkout;

use Magento\Catalog\Helper\Product;
use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\CustomerData\AbstractItem;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class ChangeImage
{
    protected $product;
    protected $productRepository;

    /**
     * AbstractItem constructor.
     *
     * @param Session $session
     */

    public function __construct(
        Session           $session,
        ProductRepository $productRepository,
        Product           $product
    ) {
        $this->session = $session;
        $this->productRepository = $productRepository;
        $this->product = $product;
    }

    /**
     * Add Your Custom Attribute to frontend storage (CustomerData)
     *
     * @param AbstractItem $subject
     * @param $result
     * @param $item
     * @return array
     * @throws NoSuchEntityException
     */
    public function afterGetItemData(AbstractItem $subject, $result, $item)
    {
        if ($result["product_type"] && $result["product_type"] = "configurable") {
            $result["product_name"] = $result["product_sku"];
            $product = $this->productRepository->get($result["product_sku"]);
            $url = $this->product->getThumbnailUrl($product);
            $result["product_image"]["src"] = $url;
        }
        return $result;
    }
}

