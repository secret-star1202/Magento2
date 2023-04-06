<?php

namespace Magenest\Movie\Ui\Component\Listing\Columns;

use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class NameDirector extends Column
{
    private $_directorCollectionFactory;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $directorCollectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->_directorCollectionFactory = $directorCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $listDir = $this->_directorCollectionFactory->create()->getData();
            foreach ($dataSource['data']['items'] as &$items) {
                foreach ($listDir as $dir) {
                    if ($items['director_id'] == $dir['director_id']) {
                        $items['director_id'] = $dir['name'];
                    }
                }
            }
        }
        return $dataSource;
    }
}
