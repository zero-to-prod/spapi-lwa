<?php

namespace Zerotoprod\SpapiLwa;

use Zerotoprod\Container\Container;
use Zerotoprod\CurlHelper\CurlHelper;
use Zerotoprod\SpapiLwa\Contracts\SpapiLwaInterface;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaFake;

/**
 * Connect to Amazons Selling Partner API with Login With Amazon (LWA).
 *
 * @link https://github.com/zero-to-prod/spapi-lwa
 */
class SpapiLwa implements SpapiLwaInterface
{

    /**
     * @var string
     */
    private $client_id;
    /**
     * @var string
     */
    private $client_secret;
    /**
     * @var string
     */
    private $base_uri;
    /**
     * @var string|null
     */
    private $user_agent;
    /**
     * @var array
     */
    private $options;

    /**
     * Instantiate the class.
     *
     * @param  string       $client_id      Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string       $client_secret  Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string       $base_uri       The LWA authentication server
     * @param  string|null  $user_agent     The user-agent for the application
     * @param  array        $options        Merge curl options
     *
     * @link https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api
     */
    private function __construct(
        string $client_id,
        string $client_secret,
        string $base_uri = 'https://api.amazon.com/auth/o2/token',
        ?string $user_agent = null,
        array $options = []
    ) {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->base_uri = $base_uri;
        $this->user_agent = $user_agent;
        $this->options = $options;
    }

    /**
     * A helper method for instantiation.
     *
     * @param  string       $client_id      Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string       $client_secret  Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string       $base_uri       The LWA authentication server
     * @param  string|null  $user_agent     The user-agent for the application
     * @param  array        $options        Merge curl options
     *
     * @link https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public static function from(
        string $client_id,
        string $client_secret,
        string $base_uri = 'https://api.amazon.com/auth/o2/token',
        ?string $user_agent = null,
        array $options = []
    ): SpapiLwaInterface {
        return Container::getInstance()->has(SpapiLwaFake::class)
            ? Container::getInstance()->get(SpapiLwaFake::class)
            : new self($client_id, $client_secret, $base_uri, $user_agent, $options);
    }

    /**
     * @inheritDoc
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public function refreshToken(
        string $refresh_token,
        array $options = []
    ): array {
        return self::post(
            $this->base_uri,
            [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'user-agent' => ($this->user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
            ],
            $this->user_agent,
            array_merge($this->options, $options)
        );
    }

    /**
     * @inheritDoc
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public function clientCredentials(string $scope, array $options = []): array
    {
        return self::post(
            $this->base_uri,
            [
                'grant_type' => 'client_credentials',
                'scope' => $scope,
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'user-agent' => ($this->user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
            ],
            $this->user_agent,
            array_merge($this->options, $options)
        );
    }

    private static function post(string $url, array $postfields, ?string $user_agent = null, array $options = []): array
    {
        $CurlHandle = curl_init();

        curl_setopt_array(
            $CurlHandle,
            [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => [
                    'accept: application/json',
                    'x-amz-date: '.gmdate('Ymd\THis\Z'),
                    'user-agent: '.($user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
                ],
                CURLOPT_POSTFIELDS => http_build_query($postfields),
                CURLOPT_POST => true,
                CURLOPT_HEADER => true,
            ] + $options
        );

        $response = curl_exec($CurlHandle);
        $info = curl_getinfo($CurlHandle);
        $error = curl_error($CurlHandle);
        $header_size = curl_getinfo($CurlHandle, CURLINFO_HEADER_SIZE);

        curl_close($CurlHandle);

        return [
            'info' => $info,
            'error' => $error,
            'headers' => CurlHelper::parseHeaders($response, $header_size),
            'response' => json_decode(substr($response, $header_size), true)
        ];
    }
}