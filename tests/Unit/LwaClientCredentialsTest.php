<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\SpapiLwa\SpapiLwa;

class LwaClientCredentialsTest extends TestCase
{
    /** @test */
    public function lwa_refresh_token_test(): void
    {
        $response = SpapiLwa::lwaClientCredentials(
            'https://httpbin.org/post',
            'scope',
            'client_id',
            'client_secret',
            'user-agent'
        );

        self::assertEquals(200, $response['info']['http_code']);
        self::assertEquals('client_id', $response['response']['form']['client_id']);
        self::assertEquals('client_secret', $response['response']['form']['client_secret']);
        self::assertEquals('scope', $response['response']['form']['scope']);
        self::assertEquals('user-agent', $response['response']['form']['user-agent']);
    }
}