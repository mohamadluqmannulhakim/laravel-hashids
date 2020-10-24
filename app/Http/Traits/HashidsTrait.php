<?php

namespace App\Http\Traits;

use Hashids\Hashids;

trait HashidsTrait
{
    public function getDecode($model, $hashid)
    {
        $className      = 'App\\' . $model;
        $model          = new $className;
        $this->hashids  = new Hashids($model->getTable(), 10);
        return $this->hashids->decode($hashid)[0];
    }
}
?>