<?php

namespace Magenest\Movie\Ui\Component\Listing\Columns;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class RatingStar extends Column
{
    private $_movieCollectionFactory;

    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory  $movieCollectionFactory,
        array              $components = [],
        array              $data = []
    ) {
        $this->_movieCollectionFactory = $movieCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if ($item['rating'] >= 0) {
                    $data = [];
                    for ($i = 0; $i < 5; $i++) {
                        if ($i < $item['rating']) {
                            $data[] = '<span style=" color: rgb(229 196 29); font-size: 50px">★</span>
                                      ';
                        } else {
                            $data[] = '<span style="color: rgb(204, 204, 204); font-size: 50px">★</span>';
                        }
                    }
                    $item['rating'] = implode('', $data);
                }
            }
        }
        return $dataSource;
    }
}
