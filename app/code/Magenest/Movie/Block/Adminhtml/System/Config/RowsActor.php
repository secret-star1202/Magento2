<?php

namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as ActorCollectionFatory;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
class RowsActor extends Field
{
    protected $_actorCollectionFactory;

    public function __construct(Context $context, ActorCollectionFatory $actorCollectionFactory)
    {
        $this->_actorCollectionFactory = $actorCollectionFactory;
        parent::__construct($context);
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        $collection = $this->_actorCollectionFactory->create();
        $rowActor = $collection->count();
        return '<span>' . $rowActor . '</span>';
    }
}
