<?php

namespace Magenest\Movie\Model\Attribute\Backend;

use Magenest\Movie\Model\Source\Validation\Image;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Avatar
 * @package Magenest\Movie\Model\Attribute\Backend
 */
class Avatar extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * @param DataObject $object
     *
     * @return $this
     * @throws LocalizedException
     */
    public function beforeSave($object)
    {
        $validation = new Image();
        $attrCode = $this->getAttribute()->getAttributeCode();
        if ($attrCode == 'profile_picture') {
            if ($validation->isImageValid('tmpp_name', $attrCode) === false) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The profile picture is not a valid image.')
                );
            }
        }

        return parent::beforeSave($object);
    }
}
