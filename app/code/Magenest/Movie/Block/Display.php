<?php

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;
use Magenest\Movie\Model\DirectorFactory;
class Display extends Template
{
    protected $_directorFactory;
    public function __construct(Template\Context $context, DirectorFactory $directorFactory)
    {
        $this->_directorFactory = $directorFactory;
        parent::__construct($context);
    }

    public function hello()
    {
        return __('Hello');
    }

    public function getDirectorCollection()
    {
        $director = $this->_directorFactory->create();
        return $director->getCollection();
    }
}
