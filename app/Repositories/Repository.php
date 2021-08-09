<?php

namespace App\Repositories;

class Repository
{
    public function itemWith($obj, $include)
    {
        return $obj->whereId($obj->id)->with($include)->first();
    }
}
