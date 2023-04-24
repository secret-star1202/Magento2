<?php

namespace Magenest\Movie\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Status extends Column
{
    private $_cacheTypeList;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if ($item['increment_id']%2==1) {
                    $result = '<span class="grid-severity-critical"><span>' . "Odd" . '</span></span>';
                } else {
                    $result = '<span class="grid-severity-notice"><span>' . "Even" . '</span></span>';
                }
                $item['odd_even'] = $result;
            }
        }
        return $dataSource;
    }
}
