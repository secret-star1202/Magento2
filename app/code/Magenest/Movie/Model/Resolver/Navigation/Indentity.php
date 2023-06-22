<?php
declare(strict_types=1);

namespace Magenest\Movie\Model\Resolver\Navigation;

namespace MyModule\CountNumberDays\Model\Resolver\Navigation;

use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class Identity implements IdentityInterface
{

    /** @var string */

    private $cacheTag = "movie_custom_product";

    /**

     * Get PromoBanners identities from resolved data

     *

     * @param array $resolvedData

     * @return string[]

     */

    public function getIdentities(array $resolvedData): array
    {
        return [ $this->cacheTag ];
    }
}
