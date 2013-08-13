Guzzle Client for Encoding.com API
================================================

[![Build Status](https://api.travis-ci.org/svilborg/guzzle-encoding-com.png?branch=master)](https://travis-ci.org/svilborg/guzzle-encoding-com)

A Guzzle client for Encoding.com's XML API .

## Installation

Install using composer

```
{
    "require" : "svilborg/guzzle-encoding-com"
}
```
## Requirements

PHP Version >=5.3.2.
PHP Guzzle Library

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
