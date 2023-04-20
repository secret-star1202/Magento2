<?php

namespace Magenest\Movie\Ui\Component\Listing\Columns;

use Magento\Catalog\Helper\Image;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

/**
 * Class Avatar
 * @package Magenest\Movie\Ui\Component\Listing\Columns
 */
class Avatar extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var AbstractBlock
     */
    protected $viewFileUrl;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param Repository $viewFileUrl
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        \Magento\Framework\View\Asset\Repository $viewFileUrl,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->viewFileUrl = $viewFileUrl;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $customer = new \Magento\Framework\DataObject($item);
                $picture_url = !empty($customer["profile_picture"]) ? $this->urlBuilder->getUrl(
                    'customer/index/viewfile/image/' . base64_encode($customer["profile_picture"])
                ) : $this->viewFileUrl->getUrl('Magenest_Movie::images/no-profile-photo.jpg');
                $item[$fieldName . '_src'] = $picture_url;
                $item[$fieldName . '_orig_src'] = $picture_url;
                $item[$fieldName . '_alt'] = 'The profile picture';
            }
        }

        return $dataSource;
    }
}
