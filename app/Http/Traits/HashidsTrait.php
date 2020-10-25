<?php

namespace App\Http\Traits;

use Hashids\Hashids;

trait HashidsTrait
{
    public function getDecode($hashid, $attribute=null)
    {
        $this->hashids  = new Hashids(config('hashids.custom_hash.salt'), config('hashids.custom_hash.length'));
        // Decode hashed value(s)
        if (is_array($hashid)) {
            $hashid = array_map(function ($item) {
                return isset( $this->hashids->decode($item)[0] ) ? $this->hashids->decode($item)[0] : $item;
            }, $hashid);
        } 
        else if (is_object($hashid)) {
            foreach ($attribute as $value) {
                $val = $hashid->$value;
                $hashid->$value = isset( $this->hashids->decode($val)[0] ) ? $this->hashids->decode($val)[0] : $val;
            }
        }
        else {
            $hashid = isset( $this->hashids->decode($hashid)[0] ) ? $this->hashids->decode($hashid)[0] : $hashid;
        }
        
        return $hashid;
    }
}

?>