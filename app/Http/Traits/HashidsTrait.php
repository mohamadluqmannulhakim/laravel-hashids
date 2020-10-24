<?php

namespace App\Http\Traits;

use Hashids\Hashids;

trait HashidsTrait
{
    public function getDecode($hashid)
    {
        $this->hashids  = new Hashids('', 10);
        return isset( $this->hashids->decode($hashid)[0] ) ? $this->hashids->decode($hashid)[0] : $hashid;
    }
}

?>