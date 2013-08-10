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
	public function __construct($baseUrl, $userid, $userkey)
	{
		parent::__construct($baseUrl);
	}

	/**
	 * Create new EncodingClient Instance
	 *
	 * @param array|Collection $config Configuration data. Array keys:
	 *
	 *    base_url - http(s)://manage.encoding.com
	 *    userid   - API User Id
	 *    userkey  - API Key
	 *
	 * @return EncodingClient
	 */
	static function factory($config = array())
	{
		$config = self::getConfigCollection($config);

		$client = new EncodingClient(
				$config->get('base_url'),
				$config->get('userid'),
				$config->get('userkey')
		);

		$client->setConfig($config);

		// Add the XML service description to the client
		$description = ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'guzzle_encoding_com.json');
		$client->setDescription($description);

		return $client;
	}

	/**
	 * Gets Config Collection instance
	 *
	 * @param unknown $config
	 * @return \Guzzle\Common\Collection
	 */
	static function getConfigCollection ($config) {
		$default  = array('base_url' => 'http://manage.encoding.com');
		$required = array('userid', 'userkey');
		$config   = Collection::fromConfig($config, $default, array('base_url', 'userid', 'userkey'));

		return $config;
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
