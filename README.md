Guzzle Client for Encoding.com API
================================================

[![Build Status](https://api.travis-ci.org/svilborg/guzzle-encoding-com.png?branch=master)](https://travis-ci.org/svilborg/guzzle-encoding-com)
[![Latest Stable Version](https://poser.pugx.org/svilborg/guzzle-encoding-com/v/stable.png)](https://packagist.org/packages/svilborg/guzzle-encoding-com)
[![Latest Unstable Version](https://poser.pugx.org/svilborg/guzzle-encoding-com/v/unstable.png)](https://packagist.org/packages/svilborg/guzzle-encoding-com)

A Guzzle client for Encoding.com's XML API . (Note : Not offical)

## Installation

Install using composer

```
{
    "require" : "svilborg/guzzle-encoding-com"
}
```

## Requirements

* PHP Version >=5.3.2.
* PHP Guzzle Library
* Requires a API Key and User ID from [Encoding.com](http://www.encoding.com/)
* [See also the API documentation](http://www.encoding.com/api)

## Usage

```php
use Gencoding\Guzzle\Encoding\EncodingClient;

$client = EncodingClient::factory(array(
	'userid' => '12345',
	'userkey' => 'X1Y2Z3A4B5C6'));

$command = $client->getCommand('GetMediaInfo', array(
	"mediaid" => 8888888888
));

$command->prepare();

try {
    $result = $command->execute();

	$resultObject = $result->getXmlElement();

} catch (\Exception $e) {
	// Catch Errors
}

```

## Running Tests

First, install PHPUnit with `composer.phar install --dev`, then run
`./vendor/bin/phpunit`.
