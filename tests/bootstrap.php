<?php
error_reporting(E_ALL | E_STRICT);

// Ensure that composer has installed all dependencies
if (! file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install --dev\n\n See http://getcomposer.org for help with installing composer\n");
}

// Include the composer autoloader
$autoloader = require dirname(__DIR__) . '/vendor/autoload.php';

// Register services with the GuzzleTestCase
Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . '/mocks');

Guzzle\Tests\GuzzleTestCase::setServiceBuilder(\Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'test' => array(
        'class' => 'Gencoding\Guzzle\Encoding\EncodingClient',
        'params' => array(
            'base_url' => 'http://localhost',
            'userid' => 'xx',
            'userkey' => 'xx'
        )
    )
)));
