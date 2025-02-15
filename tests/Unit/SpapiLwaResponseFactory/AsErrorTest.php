<?php

namespace Tests\Unit\SpapiLwaResponseFactory;

use Tests\TestCase;
use Zerotoprod\SpapiLwa\SpapiLwa;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaFake;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaResponseFactory;

class AsErrorTest extends TestCase
{
    /** @test */
    public function asError(): void
    {
        SpapiLwaFake::fake(
            SpapiLwaResponseFactory::factory()
                ->asError(['test' => 'test'])
                ->make()
        );

        $response = SpapiLwa::from('client_id', 'client_secret')
            ->clientCredentials('scope');

        self::assertEquals('test', $response['response']['test']);
        self::assertEquals('Client authentication failed', $response['response']['error_description']);
        self::assertEquals('invalid_client', $response['response']['error']);
    }
}