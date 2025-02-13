<?php

namespace Zerotoprod\SpapiLwa\Contracts;

interface SpapiLwaInterface
{
    public function refreshToken(string $refresh_token, array $options = []): array;

    public function clientCredentials(string $scope, array $options = []): array;
}