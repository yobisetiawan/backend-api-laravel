<?php

use Illuminate\Validation\ValidationException;

if (!function_exists('custom_error')) {

    function custom_error($message, $status = 422)
    {
        if ($status == 422 && is_array($message)) {
            $validator = Validator::make([], []); // Empty data and rules fields

            foreach ($message as $key => $msg) {
                $validator->errors()->add($key, $msg);
            }

            throw new ValidationException($validator);
        }

        abort($status, $message);
    }
}
