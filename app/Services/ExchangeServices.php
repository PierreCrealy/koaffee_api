<?php

namespace App\Services;

class ExchangeServices
{

    private  function getKey()
    {
        return substr(hash('sha256', config('custom.encrypt_key')), 0 , 32);
    }

    private function getIv()
    {
        return substr(hash('sha256', config('custom.encrypt_iv')), 0 , 16);
    }

    public static function encryptAES($data) {
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', (new ExchangeServices)->getKey(), 0, (new ExchangeServices)->getIv()));
    }

    public static function decryptAES($data) {
        return openssl_decrypt(base64_decode($data), 'AES-256-CBC', (new ExchangeServices)->getKey(), 0, (new ExchangeServices)->getIv());
    }
}
