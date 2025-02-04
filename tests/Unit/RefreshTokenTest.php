<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\SpapiLwa\SpapiLwa;

class RefreshTokenTest extends TestCase
{
    /** @test */
    public function refresh_token(): void
    {
        $response = SpapiLwa::refreshToken(
            'https://httpbin.org/post',
            'refresh_token',
            'client_id',
            'client_secret',
            'user-agent'
        );

        self::assertEquals(200, $response['info']['http_code']);
        self::assertEquals('client_id', $response['response']['form']['client_id']);
        self::assertEquals('client_secret', $response['response']['form']['client_secret']);
        self::assertEquals('refresh_token', $response['response']['form']['grant_type']);
        self::assertEquals('user-agent', $response['response']['form']['user-agent']);
    }
}