<?php

namespace Tests\Unit\SpapiLwaResponseFactory;

use Tests\TestCase;
use Zerotoprod\SpapiLwa\SpapiLwa;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaFake;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaResponseFactory;

class AsRefreshTokenTest extends TestCase
{
    /** @test */
    public function asRefreshTokenResponse(): void
    {
        SpapiLwaFake::fake(
            SpapiLwaResponseFactory::factory()
                ->asRefreshTokenResponse()
                ->make()
        );

        $response = SpapiLwa::from('client_id', 'client_secret')
            ->refreshToken('refresh_token');

        self::assertEquals(200, $response['info']['http_code']);
        self::assertEquals('access_token', $response['response']['access_token']);
        self::assertEquals('refresh_token', $response['response']['refresh_token']);
        self::assertEquals('bearer', $response['response']['token_type']);
        self::assertEquals(3600, $response['response']['expires_in']);
    }
}