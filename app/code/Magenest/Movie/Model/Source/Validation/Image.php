<?php

namespace Magenest\Movie\Model\Source\Validation;

class Image
{
    public function isImageValid($tmp_name, $attrCode)
    {
        if ($attrCode == 'avatar') {
            if (!empty($_FILES[$attrCode][$tmp_name])) {
                $imageFile = @getimagesize($_FILES[$attrCode][$tmp_name]);
                if ($imageFile === false) {
                    return false;
                } else {
                    $valid_types = ['image/gif', 'image/jpeg', 'image/png'];
                    if (!in_array($imageFile['mime'], $valid_types)) {
                        return false;
                    }
                }
                return true;
            }
        }
        return true;
    }
}
