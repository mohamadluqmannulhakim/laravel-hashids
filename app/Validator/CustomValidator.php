<?php

namespace App\Validator;

use Illuminate\Validation\Validator as BaseValidator;
use App\Http\Traits\HashidsTrait;

class CustomValidator extends BaseValidator
{
    use HashidsTrait;

    public function validateExistsHashed($attribute, $value, $parameters, $validator)
    {
        // Decode hashed value(s)
        if (is_array($value)) {
            $value = array_map(function ($item) {
                return $this->getDecode($item);
            }, $value);
        } else {
            $value = $this->getDecode($value);
        }

        return $this->validateExists($attribute, $value, $parameters);
    }
    
}


?>