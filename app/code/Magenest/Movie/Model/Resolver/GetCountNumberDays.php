<?php

namespace Magenest\Movie\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class GetCountNumberDays implements ResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(
        Field       $field,
                    $context,
        ResolveInfo $info,
        array       $value = null,
        array       $args = null
    )
    {
        if (!isset($args['input']['month']) || !isset($args['input']['year'])) {
            throw new GraphQlInputException(__('Month or Year not indicated'));
        }

        return [
            'days' => cal_days_in_month(CAL_GREGORIAN, $args['input']['month'], $args['input']['year'])
        ];
    }
}
