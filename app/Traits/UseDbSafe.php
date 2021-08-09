<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UseDbSafe
{
    public function dbSafe($func, $callback = null)
    {
        DB::beginTransaction();

        try {
            $data = $func();
            DB::commit();
            if ($callback) {
                return $callback($data);
            }
            return $data;
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
