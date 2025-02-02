<?php

namespace Zerotoprod\SpapiLwa;

class SpapiLwa
{
    /**
     * @return array{info: mixed, error: string, response: array{access_token:string, refresh_token:string, token_type:string, expires_in: string}}
     * @link https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api#step-1-request-a-login-with-amazon-access-token
     */
    public static function refreshToken(string $url, string $refresh_token, string $client_id, string $client_secret, ?string $user_agent = null): array
    {
        $CurlHandle = curl_init($url);

        curl_setopt_array($CurlHandle, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'user-agent' => ($user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
            ]),
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($CurlHandle);
        $info = curl_getinfo($CurlHandle);
        $error = curl_error($CurlHandle);

        curl_close($CurlHandle);

        return [
            'info' => $info,
            'error' => $error,
            'response' => json_decode($response, true)
        ];
    }

    /**
     * @return array{info: mixed, error: string, response: array{access_token:string, scope:string, token_type:string, expires_in: string}}
     * @link https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api#step-1-request-a-login-with-amazon-access-token
     */
    public static function clientCredentials(string $url, string $scope, string $client_id, string $client_secret, ?string $user_agent = null): array
    {
        $CurlHandle = curl_init($url);

        curl_setopt_array($CurlHandle, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'grant_type' => 'client_credentials',
                'scope' => $scope,
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'user-agent' => ($user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
            ]),
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($CurlHandle);
        $info = curl_getinfo($CurlHandle);
        $error = curl_error($CurlHandle);

        curl_close($CurlHandle);

        return [
            'info' => $info,
            'error' => $error,
            'response' => json_decode($response, true)
        ];
    }
}