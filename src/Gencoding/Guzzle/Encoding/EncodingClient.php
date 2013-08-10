<?php

namespace Gencoding\Guzzle\Encoding;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Common\Collection;
use Guzzle\Service\Description\ServiceDescription;

class EncodingClient extends Client
{
	/**
	 * Client constructor
	 *
	 * @param string $baseUrl Base URL of the web service
	 */
	public function __construct($baseUrl, $username, $password)
	{
		parent::__construct($baseUrl);
	}

	/**
	 * Create new EncodingClient Instance
	 *
	 * @param array|Collection $config Configuration data. Array keys:
	 *
	 *    base_url - Base URL of the smsBox service endpoint
	 *    userid - API Username
	 *    userkey - API Key
	 *
	 * @return EncodingClient
	 */
	static function factory($config = array())
	{
		$default  = array('test' => false);
		$required = array('base_url', 'username', 'password');
		$config   = Collection::fromConfig($config, $default, array('base_url', 'userid', 'userkey'));

		$client = new self(
				$config->get('base_url'),
				$config->get('username'),
				$config->get('password'),
				$config->get('test')
		);
		$client->setConfig($config);

		// Add the XML service description to the client
		$description = ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'guzzle_encoding_com.json');
		$client->setDescription($description);

		return $client;
	}


	/**
	 * {@inheritdoc}
	 */
	public function createRequest($method = RequestInterface::GET, $uri = null, $headers = null, $body = null,  array $options = array())
	{
		$request = parent::createRequest($method, $uri, $headers, $body, $options);
		$request->setHeader('Content-Type', 'text/xml');

		return $request;
	}
}
