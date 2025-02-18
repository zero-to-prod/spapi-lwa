<?php

namespace Zerotoprod\SpapiLwa\Support\Testing;

use Zerotoprod\Factory\Factory;

/**
 * @link https://github.com/zero-to-prod/spapi-lwa
 */
class SpapiLwaResponseFactory
{
    use Factory;

    private function definition(): array
    {
        return [
            'info' => [
                'url' => 'https://api.amazon.com/auth/o2/token',
                'content_type' => 'application/json;charset=UTF-8',
                'http_code' => 200,
                'header_size' => 485,
                'request_size' => 898,
                'filetime' => -1,
                'ssl_verify_result' => 0,
                'redirect_count' => 0,
                'total_time' => 0.359889,
                'namelookup_time' => 0.070204,
                'connect_time' => 0.150098,
                'pretransfer_time' => 0.235468,
                'size_upload' => 619,
                'size_download' => 763,
                'speed_download' => 2125,
                'speed_upload' => 1724,
                'download_content_length' => 763,
                'upload_content_length' => 619,
                'starttransfer_time' => 0.359795,
                'redirect_time' => 0,
                'redirect_url' => '',
                'primary_ip' => '98.82.156.189',
                'certinfo' => [],
                'primary_port' => 443,
                'local_ip' => '172.20.0.2',
                'local_port' => 56232,
            ],
            'error' => '',
            'headers' => [
                'Server' => 'Server',
                'Date' => 'Thu, 13 Feb 2025 19:37:11 GMT',
                'Content-Type' => 'application/json;charset=UTF-8',
                'Content-Length' => '763',
                'Connection' => 'keep-alive',
                'X-Amz-Rid' => 'DCTFJ9AFPC1MM9Z605M2',
                'X-Amzn-Requestid' => '5cac54f3-9d1e-432f-a05a-a6c101b93eab',
                'X-Amz-Date' => 'Thu, 13 Feb 2025 19:37:11 GMT',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Vary' => 'Content-Type,Accept-Encoding,User-Agent',
                'Strict-Transport-Security' => 'max-age=47474747; includeSubDomains; preload',
            ],
            'response' => [
                'access_token' => 'access_token',
                'token_type' => 'bearer',
                'expires_in' => 3600,
            ],
        ];
    }

    /**
     * Generates a response for a refresh token.
     *
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public function asRefreshTokenResponse(string $refresh_token = 'refresh_token'): self
    {
        return $this->state('response.refresh_token', $refresh_token);
    }

    /**
     * Generates a response for client credentials.
     *
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public function asClientCredentialsResponse(string $scope = 'scope'): self
    {
        return $this->state('response.scope', $scope);
    }

    /**
     * Generates an error response.
     *
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public function asError(array $merge = []): self
    {
        return $this->state(
            'response',
            [
                'error_description' => 'Client authentication failed',
                'error' => 'invalid_client',
            ] + $merge
        );
    }
}