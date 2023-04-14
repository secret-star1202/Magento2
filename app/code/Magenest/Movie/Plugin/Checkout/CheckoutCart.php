<?php

namespace Magenest\Movie\Plugin\Checkout;

use Magento\Catalog\Helper\Product;
use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\Block\Cart\Item\Renderer;
use Magento\Framework\Exception\NoSuchEntityException;

class CheckoutCart
{
    protected $product;
    protected $productRepository;

    /**
     * AbstractItem constructor.
     *
     * @param Product $product
     */
    public function __construct(
        ProductRepository $productRepository,
        Product           $product
    ) {
        $this->productRepository = $productRepository;
        $this->product = $product;
    }

    /**
     * Add Your Custom Attribute to frontend storage (CustomerData)
     *
     * @param Renderer $subject
     * @param $result
     * @throws NoSuchEntityException
     */

    public function afterGetProductForThumbnail(Renderer $subject, $result)
    {
        $sku = $subject->getItem()->getData('sku');
        if ($result["type_id"]) {
            $result["name"] = $sku;
            $product = $this->productRepository->get($sku);
        }
        return $product;
    }
}
