<?php

namespace Zerotoprod\SpapiLwa\Support\Testing;

use Zerotoprod\Container\Container;
use Zerotoprod\SpapiLwa\Contracts\SpapiLwaInterface;

class SpapiLwaFake implements SpapiLwaInterface
{
    /**
     * @var array
     */
    private $response;

    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    public function refreshToken(string $refresh_token, array $options = []): array
    {
        return $this->response;
    }

    public function clientCredentials(string $scope, array $options = []): array
    {
        return $this->response;
    }

    /**
     * Fakes a response
     */
    public static function fake(array $response = [], ?SpapiLwaInterface $fake = null): SpapiLwaInterface
    {
        Container::getInstance()
            ->instance(
                SpapiLwaFake::class,
                $instance = $fake ?? new SpapiLwaFake($response)
            );

        return $instance;
    }
}