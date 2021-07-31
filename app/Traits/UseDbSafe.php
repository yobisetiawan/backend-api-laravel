<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UseDbSafe
{
    public function dbSafe($func, $callback)
    {
        DB::beginTransaction();

        try {
            $data = $func();
            DB::commit();
            return $callback($data);
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
