<?php

namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magenest\Movie\Model\MovieFactory;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as MovieCollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;

class RowsMovie extends Field
{
    protected $_movieCollectionFactory;
    public function __construct(Context $context, MovieCollectionFactory $movieCollectionFactory)
    {
        $this->_movieCollectionFactory = $movieCollectionFactory;
        parent::__construct($context);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $collection = $this->_movieCollectionFactory->create();
        $rowMovie = $collection->count();
        return '<span>' . $rowMovie . '</span>';
    }
}
