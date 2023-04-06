<?php

namespace Magenest\Movie\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;

abstract class Movie extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Magenest_Movie::movie';
    protected $_coreRegistry;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Magenest_Movie::magenest_movie_movie')
            ->addBreadcrumb(__('Magenest_Movie'), __('Magenest_Movie'))
            ->addBreadcrumb(__('Static Movies'), __('Static Movie'));
        return $resultPage;
    }

}

