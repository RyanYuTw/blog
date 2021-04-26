<?php

namespace App\Services;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use DateTimeImmutable;

class JwtService
{
    protected static $objToken = null;
    protected static $instance = null;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    /**
     * 產生 Jwt Token
     *
     * @param string $expiresAt
     * @return void
     */
    public static function generate(array $options, string $expiresAt = "+15 minutes")
    {
        $config = self::configInit();

        $builder = $config->builder();
        foreach ($options as $k => $v) {
            $builder->withClaim($k, $v);
        }

        $now   = new DateTimeImmutable();

        $token = $builder
                // Configures the time that the token was issue (iat claim)
                ->issuedAt($now)
                // Configures the expiration time of the token (exp claim)
                ->expiresAt($now->modify($expiresAt))
                // Configures a new header, called "foo"
                ->withHeader('foo', 'bar')
                // ->withClaim('test1', 'test1')
                // ->withClaim('test2', 'test2')
                // Builds a new token
                ->getToken($config->signer(), $config->signingKey());

        return $token;
    }

    public static function verify(string $strToken, string $signKey)
    {
        // $objToken = (new Parser())->parse((string) $strToken);

        // $rs_key = $objToken->verify(new Sha256(), $signKey);
        // $rs_exp = $objToken->validate(new ValidationData());

        // if ($rs_key && $rs_exp) {
        //     self::$objToken = $objToken;

        //     $result = true;
        // } else {
        //     $result = false;
        // }

        // return $result;
    }

    /**
     *
     */

    public static function get(string $key)
    {
        // return self::$objToken->hasClaim($key) ? self::$objToken->getClaim($key) : null;
    }


    /**
     * 以 APP_KEY 加密為簽章並建立組態
     *
     * @return void
     */
    public static function configInit()
    {
        $appKey = self::getAppKey(env('APP_KEY'));
        return Configuration::forSymmetricSigner(
                    // You may use any HMAC variations (256, 384, and 512)
                    new Sha256(),
                    // replace the value below with a key of your own!
                    InMemory::base64Encoded($appKey)
                    // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
                );
    }

    /**
     * 取得 APP KEY
     * @return string
     */
    public static function getAppKey()
    {
        $appKey = env('APP_KEY');
        $arrAppKey = explode('base64:', $appKey);
        return (is_array($arrAppKey) && count($arrAppKey) == 2) ? $arrAppKey[1] : null;
    }

}
