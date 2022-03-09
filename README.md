[![PHP from Packagist](https://img.shields.io/packagist/php-v/whatcoloris/api-client)](http://www.php.net)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/9bd77f35bfb44f8c80bdb5069b62ed4a)](https://www.codacy.com/gh/BitAndBlack/whatcoloris-api-client/dashboard)
[![Latest Stable Version](https://poser.pugx.org/whatcoloris/api-client/v/stable)](https://packagist.org/packages/whatcoloris/api-client)
[![Total Downloads](https://poser.pugx.org/whatcoloris/api-client/downloads)](https://packagist.org/packages/whatcoloris/api-client)
[![License](https://poser.pugx.org/whatcoloris/api-client/license)](https://packagist.org/packages/whatcoloris/api-client)

# WhatColorIs API Client

A PHP client for the [WhatColorIs](https://www.whatcolor.is) REST API.

## Installation 

This library is made for the use with [Composer](https://packagist.org/packages/whatcoloris/api-client). Add it to your project by running `$ composer require whatcoloris/api-client`.

## Usage

**Please note**: this library requires you to have a valid API token.

### Set up the client

Add you API token at first and initialize the client then:

```php
<?php

use WhatColorIs\APIClient\ColorInformationLoader\WhatColorIsAPI;

WhatColorIsAPI::setApiKey('token');

$whatColorIsAPI = new WhatColorIsAPI();
```

### Request a color system

Request information about a specific color system:

```php
<?php

use WhatColorIs\APIClient\Enum\ColorSystem;

$response = $whatColorIsAPI->requestColorSystem(ColorSystem::PANTONE());
```

### Request a color value

Request information about a specific color:

```php
<?php

use WhatColorIs\APIClient\Enum\ColorSystem;

$response = $whatColorIsAPI->requestColorValue(ColorSystem::PANTONE(), 'PANTONE 215 C');
```

### Integration

You don't need to handle the response data by your own. The [Bit&Black Colors library](https://packagist.org/packages/bitandblack/colors) has a perfect integration and allows to handle the colors in an object-oriented way.

### Available color systems

The available color systems are:

-   `CIELAB`
-   `CMYK`
-   `HEX`
-   `HKS`
-   `HSL`
-   `PANTONE`
-   `RAL`
-   `RGB`

## Help 

If you have any questions, feel free to contact us under `hello@bitandblack.com`.

Further information about Bit&Black can be found under [www.bitandblack.com](https://www.bitandblack.com).