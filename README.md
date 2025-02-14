# Zerotoprod\SpapiLwa

![](art/logo.png)

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/spapi-lwa)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/spapi-lwa/test.yml?label=test)](https://github.com/zero-to-prod/spapi-lwa/actions)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/spapi-lwa/backwards_compatibility.yml?label=backwards_compatibility)](https://github.com/zero-to-prod/spapi-lwa/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/spapi-lwa?color=blue)](https://packagist.org/packages/zero-to-prod/spapi-lwa/stats)
[![php](https://img.shields.io/packagist/php-v/zero-to-prod/spapi-lwa.svg?color=purple)](https://packagist.org/packages/zero-to-prod/spapi-lwa/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/spapi-lwa?color=f28d1a)](https://packagist.org/packages/zero-to-prod/spapi-lwa)
[![License](https://img.shields.io/packagist/l/zero-to-prod/spapi-lwa?color=pink)](https://github.com/zero-to-prod/spapi-lwa/blob/main/LICENSE.md)
[![wakatime](https://wakatime.com/badge/github/zero-to-prod/spapi-lwa.svg)](https://wakatime.com/badge/github/zero-to-prod/spapi-lwa)
[![Hits-of-Code](https://hitsofcode.com/github/zero-to-prod/spapi-lwa?branch=main)](https://hitsofcode.com/github/zero-to-prod/spapi-lwa/view?branch=main)

## Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
    - [Access Toke from Refresh Token](#access-toke-from-refresh-token)
    - [Access Toke from Scope](#access-token-from-scope)
- [Testing](#testing)
- [Local Development](./LOCAL_DEVELOPMENT.md)
- [Contributing](#contributing)

## Introduction

Connect to Amazons Selling Partner API with [Login With Amazon](https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api) (
LWA).

## Requirements

- PHP 7.1 or higher.

## Installation

Install `Zerotoprod\SpapiLwa` via [Composer](https://getcomposer.org/):

```bash
composer require zero-to-prod/spapi-lwa
```

This will add the package to your project’s dependencies and create an autoloader entry for it.

## Usage

### Access Toke from Refresh Token

Use this for calling operations that require authorization from a selling partner. All operations that are not grantless operations require
authorization from a selling partner. When specifying this value, include the rrefresh_token parameter.

```php
use Zerotoprod\SpapiLwa\SpapiLwa;

$response = SpapiLwa::from('client_id','client_secret')
    ->refreshToken('refresh_token');

$access_token = $response['response']['access_token'];
```

### Access Token from Scope

Use this for calling grantless operations. When specifying this value, include the scope parameter.

```php
use Zerotoprod\SpapiLwa\SpapiLwa;

$response = SpapiLwa::from('client_id','client_secret')
    ->clientCredentials('scope');

$access_token = $response['response']['access_token'];
```

## Testing
You can test the api by faking the response:
```php
use Zerotoprod\SpapiLwa\SpapiLwa;
use Zerotoprod\SpapiLwa\Support\Testing\SpapiLwaResponseFactory;

SpapiLwa::fake(SpapiLwaResponseFactory::clientCredentialsOk());

SpapiLwa::from('client_id', 'client_secret')
```

## Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check the [issues](https://github.com/zero-to-prod/spapi-lwa/issues) page if you want to contribute.

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.
