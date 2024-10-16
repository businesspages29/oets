<?php

use Illuminate\Support\Facades\Crypt;

if (! function_exists('encryptId')) {
    function encryptId($id)
    {
        return Crypt::encryptString($id);
    }
}

if (! function_exists('decryptId')) {
    function decryptId($id)
    {
        return Crypt::decryptString($id);
    }
}
