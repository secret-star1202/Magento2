<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Block\Adminhtml\Block\Edit;
use Magento\Backend\Block\Widget\Context;

/**
 * Class GenericButton
 */
class GenericButton
{

    /**
     * Constructor
     *
     * @param Context $context
     */
    protected $context;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }
    /**
     * Return movie ID
     *
     * @return int|null
     */
    public function getMovieId()
    {
        return $this->context->getRequest()->getParam('movie_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
