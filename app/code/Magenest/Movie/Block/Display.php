<?php

namespace Magenest\Movie\Block;

use Magenest\Movie\Model\DirectorFactory;
use Magento\Framework\View\Element\Template;

class Display extends Template
{
    protected $_directorFactory;
    public function __construct(Template\Context $context, DirectorFactory $directorFactory)
    {
        $this->_directorFactory = $directorFactory;
        parent::__construct($context);
    }

    public function getDirectorCollection()
    {
        $director = $this->_directorFactory->create();
        return $director->getCollection()->addFieldToSelect('*')->setPageSize(10)->load();
    }
}
