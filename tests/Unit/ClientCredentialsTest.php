<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\SpapiLwa\SpapiLwa;

class ClientCredentialsTest extends TestCase
{
    /** @test */
    public function client_credentials(): void
    {
        $response = SpapiLwa::from(
            'client_id',
            'client_secret',
            'https://httpbin.org/post',
            'user-agent'
        )->clientCredentials('scope');

        self::assertEquals(200, $response['info']['http_code']);
        self::assertEquals('client_id', $response['response']['form']['client_id']);
        self::assertEquals('client_secret', $response['response']['form']['client_secret']);
        self::assertEquals('scope', $response['response']['form']['scope']);
        self::assertEquals('user-agent', $response['response']['form']['user-agent']);
    }
}