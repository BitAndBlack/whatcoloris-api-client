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

**Please note** that this library requires you to have a valid API token.

```php
<?php

use WhatColorIs\APIClient\ColorInformationLoader\WhatColorIsAPI;
use WhatColorIs\APIClient\Enum\ColorSystem;

WhatColorIsAPI::setApiKey('token');

$whatColorIsAPI = new WhatColorIsAPI();
$response = $whatColorIsAPI->requestColorValue(ColorSystem::RGB(), '125 255 0');
```

## Help 

If you have any questions, feel free to contact us under `hello@bitandblack.com`.

Further information about Bit&Black can be found under [www.bitandblack.com](https://www.bitandblack.com).