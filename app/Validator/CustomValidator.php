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
        $value = $this->getDecode($value);
        return $this->validateExists($attribute, $value, $parameters);
    }
    
}


?>