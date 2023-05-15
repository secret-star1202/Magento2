<?php

namespace Magenest\Movie\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\View\Element\Template;

class ColorHeader extends Template
{
    /**
     * @var \Magento\Framework\Data\Helper\PostHelper
     */
    protected $_postDataHelper;

    private $scopeConfig;
    const COLOROPTION = 'colorheader/settings/coloroption';

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        PostHelper $postDataHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->_postDataHelper = $postDataHelper;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function getColorConfig()
    {
        $config = $this->scopeConfig->getValue(static::COLOROPTION);
        return (array)json_decode($config, true);
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function getColor()
    {
        $colorOptionConfig = $this->getColorConfig();
        $array = [];
        foreach ($colorOptionConfig as $valueConfig) {
            $array[$valueConfig['color']] =  __($valueConfig['color_picker']);
        }
        return $array;
    }
}
