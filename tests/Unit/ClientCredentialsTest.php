<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\SpapiLwa\SpapiLwa;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaResponseFactory;

class ClientCredentialsTest extends TestCase
{
    /** @test */
    public function client_credentials(): void
    {
        SpapiLwa::fake(SpapiLwaResponseFactory::clientCredentialsOk());

        $response = SpapiLwa::from('client_id', 'client_secret')
            ->clientCredentials('scope');

        self::assertEquals(200, $response['info']['http_code']);
        self::assertEquals('access_token', $response['response']['access_token']);
        self::assertEquals('sellingpartnerapi::notifications', $response['response']['scope']);
        self::assertEquals('bearer', $response['response']['token_type']);
        self::assertEquals(3600, $response['response']['expires_in']);
    }
}