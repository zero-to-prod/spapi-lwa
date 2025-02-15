<?php

namespace Zerotoprod\SpapiLwa\Support\Testing;

use Zerotoprod\Container\Container;
use Zerotoprod\SpapiLwa\Contracts\SpapiLwaInterface;

/**
 * Fake responses with this class.
 *
 * @link https://github.com/zero-to-prod/spapi-lwa
 */
class SpapiLwaFake implements SpapiLwaInterface
{
    /**
     * @var array
     */
    private $response;

    /** @link https://github.com/zero-to-prod/spapi-lwa */
    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public function refreshToken(string $refresh_token, array $options = []): array
    {
        return $this->response;
    }

    /**
     * @inheritDoc
     * @link https://github.com/zero-to-prod/spapi-lwa
     */
    public function clientCredentials(string $scope, array $options = []): array
    {
        return $this->response;
    }

    /**
     * Fakes a response.
     *
     * @link https://github.com/zero-to-prod/spapi-lwa
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