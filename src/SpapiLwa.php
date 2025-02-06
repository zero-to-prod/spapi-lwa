<?php

namespace Zerotoprod\SpapiLwa;

use Zerotoprod\CurlHelper\CurlHelper;

class SpapiLwa
{
    /**
     * Use this for calling operations that require authorization from a selling partner. All operations that are not grantless operations require authorization from a selling partner. When specifying this value, include the rrefresh_token parameter.
     *
     * @param  string       $base_uri       The LWA authentication server
     * @param  string       $refresh_token  The LWA refresh token. Get this value when the selling partner authorizes your application. For more information, refer to Authorizing Selling Partner API applications.
     * @param  string       $client_id      Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string       $client_secret  Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string|null  $user_agent     The user-agent for the application
     * @param  array        $options        Curl options
     *
     * @return array{
     *     info: array{
     *         url: string,
     *         content_type: string,
     *         http_code: int,
     *         header_size: int,
     *         request_size: int,
     *         filetime: int,
     *         ssl_verify_result: int,
     *         redirect_count: int,
     *         total_time: float,
     *         namelookup_time: float,
     *         connect_time: float,
     *         pretransfer_time: float,
     *         size_upload: int,
     *         size_download: int,
     *         speed_download: int,
     *         speed_upload: int,
     *         download_content_length: int,
     *         upload_content_length: int,
     *         starttransfer_time: float,
     *         redirect_time: float,
     *         redirect_url: string,
     *         primary_ip: string,
     *         certinfo: array,
     *         primary_port: int,
     *         local_ip: string,
     *         local_port: int,
     *         http_version: int,
     *         protocol: int,
     *         ssl_verifyresult: int,
     *         scheme: string,
     *         appconnect_time_us: int,
     *         connect_time_us: int,
     *         namelookup_time_us: int,
     *         pretransfer_time_us: int,
     *         redirect_time_us: int,
     *         starttransfer_time_us: int,
     *         total_time_us: int
     *     },
     *     error: string,
     *     headers: array{
     *         Server: string,
     *         Date: string,
     *         Content-Type: string,
     *         Content-Length: string,
     *         Connection: string,
     *         'x-amz-rid': string,
     *         'x-amzn-RequestId': string,
     *         'X-Amz-Date': string,
     *         'Cache-Control': string,
     *         Pragma: string,
     *         Vary: string,
     *         'Strict-Transport-Security': string
     *     },
     *     response: array{
     *         access_token: string,
     *         refresh_token: string,
     *         token_type: string,
     *         expires_in: int
     *     }
     * }
     *
     * @link https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api#step-1-request-a-login-with-amazon-access-token
     */
    public static function refreshToken(
        string $base_uri,
        string $refresh_token,
        string $client_id,
        string $client_secret,
        ?string $user_agent = null,
        array $options = []
    ): array {
        return self::post(
            $base_uri,
            [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'user-agent' => ($user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
            ],
            $user_agent,
            $options
        );
    }

    /**
     * Use this for calling grantless operations. When specifying this value, include the scope parameter.
     *
     * @param  string       $base_uri       The LWA authentication server
     * @param  string       $scope          The scope of the LWA authorization grant. Values:
     *                                      - sellingpartnerapi::notifications. For the Notifications API.
     *                                      - sellingpartnerapi::client_credential:rotation. For the Application Management API.
     * @param  string       $client_id      Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string       $client_secret  Get this value when you register your application. Refer to Viewing your developer information.
     * @param  string|null  $user_agent     The user-agent for the application
     * @param  array        $options        Curl options
     *
     * @return array{
     *      info: array{
     *          url: string,
     *          content_type: string,
     *          http_code: int,
     *          header_size: int,
     *          request_size: int,
     *          filetime: int,
     *          ssl_verify_result: int,
     *          redirect_count: int,
     *          total_time: float,
     *          namelookup_time: float,
     *          connect_time: float,
     *          pretransfer_time: float,
     *          size_upload: int,
     *          size_download: int,
     *          speed_download: int,
     *          speed_upload: int,
     *          download_content_length: int,
     *          upload_content_length: int,
     *          starttransfer_time: float,
     *          redirect_time: float,
     *          redirect_url: string,
     *          primary_ip: string,
     *          certinfo: array,
     *          primary_port: int,
     *          local_ip: string,
     *          local_port: int,
     *          http_version: int,
     *          protocol: int,
     *          ssl_verifyresult: int,
     *          scheme: string,
     *          appconnect_time_us: int,
     *          connect_time_us: int,
     *          namelookup_time_us: int,
     *          pretransfer_time_us: int,
     *          redirect_time_us: int,
     *          starttransfer_time_us: int,
     *          total_time_us: int
     *      },
     *      error: string,
     *      headers: array{
     *          Server: string,
     *          Date: string,
     *          Content-Type: string,
     *          Content-Length: string,
     *          Connection: string,
     *          'x-amz-rid': string,
     *          'x-amzn-RequestId': string,
     *          'X-Amz-Date': string,
     *          'Cache-Control': string,
     *          Pragma: string,
     *          Vary: string,
     *          'Strict-Transport-Security': string
     *      },
     *      response: array{
     *          access_token: string,
     *          scope: string,
     *          token_type: string,
     *          expires_in: int
     *      }
     *  }
     * @link https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api#step-1-request-a-login-with-amazon-access-token
     */
    public static function clientCredentials(
        string $base_uri,
        string $scope,
        string $client_id,
        string $client_secret,
        ?string $user_agent = null,
        array $options = []
    ): array {
        return self::post(
            $base_uri,
            [
                'grant_type' => 'client_credentials',
                'scope' => $scope,
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'user-agent' => ($user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
            ],
            $user_agent,
            $options
        );
    }

    private static function post(string $url, array $postfields, ?string $user_agent = null, array $options = []): array
    {
        $CurlHandle = curl_init($url);

        curl_setopt_array(
            $CurlHandle,
            [
                CURLOPT_HTTPHEADER => [
                    'x-amz-date: '.gmdate('Ymd\THis\Z'),
                    'user-agent: '.($user_agent ?: '(Language=PHP/'.PHP_VERSION.'; Platform='.php_uname('s').'/'.php_uname('r').')')
                ],
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($postfields),
                CURLOPT_RETURNTRANSFER => true,
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