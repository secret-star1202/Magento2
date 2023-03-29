<?php

namespace Magenest\Movie\Controller\Index;

use Magenest\Movie\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Config extends Action
{
    protected $helperData;
    public function __construct(Context $context, Data $helperData)
    {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo $this->helperData->getGeneralConfig('enable');
        echo $this->helperData->getGeneralConfig('display_text');
        exit();
    }
}
