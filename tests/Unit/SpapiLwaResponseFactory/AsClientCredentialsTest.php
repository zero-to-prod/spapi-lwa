<?php

namespace Tests\Unit\SpapiLwaResponseFactory;

use Tests\TestCase;
use Zerotoprod\SpapiLwa\SpapiLwa;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaFake;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaResponseFactory;

class AsClientCredentialsTest extends TestCase
{
    /** @test */
    public function asClientCredentials(): void
    {
        SpapiLwaFake::fake(
            SpapiLwaResponseFactory::factory()
                ->asClientCredentialsResponse()
                ->make()
        );

        $response = SpapiLwa::from('client_id', 'client_secret')
            ->clientCredentials('scope');

        self::assertEquals(200, $response['info']['http_code']);
        self::assertEquals('access_token', $response['response']['access_token']);
        self::assertEquals('scope', $response['response']['scope']);
        self::assertEquals('bearer', $response['response']['token_type']);
        self::assertEquals(3600, $response['response']['expires_in']);
    }
}