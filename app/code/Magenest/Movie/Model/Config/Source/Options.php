<?php

namespace Magenest\Movie\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Options implements ArrayInterface
{
    /**
     * Options for Type
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' =>  1, 'label' => __('show')],
            ['value' =>  2, 'label' => __('not-show')]
        ];
    }
}
