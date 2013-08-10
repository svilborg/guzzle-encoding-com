<?php

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;

class EncodingClientTest extends \PHPUnit_Framework_TestCase
{
	protected $base_url;
	protected $userid;
	protected $userkey;

	public function setUp() {

		$this->userid  = "test";
		$this->userkey = "test";

		$this->object = EncodingClient::factory(array(
				'base_url' => 'http://manage.encoding.com',
				'userid'   => '1',
				'userkey'  => 'test'
		));
	}

// 	public function testMissingParamsException() {
// 		$this->setExpectedException("InvalidArgumentException");

// 		$object = EncodingClient::factory();
// 	}

// 	public function testWrongAuthException() {
// 		$this->setExpectedException("Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException");

// 		$object = EncodingClient::factory(array(
// 				'base_url' => 'http://manage.encoding.com',
// 				'userid'   => '1',
// 				'userkey'  => 'test'
// 		));

// 		$command = $this->object->getCommand('AddMedia',
// 				array()
// 		);

// 		$media = $command->execute();
// 	}

	public function testAddMedia() {

		$command = $this->object->getCommand('AddMedia',
				array()
		);

		try {
			$media = $command->execute();
		} catch (Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException $e) {

			$this->fail('AddMedia command failed - ' . $e->getMessage());
		}
	}

	protected function tearDown() {
		parent::tearDown();
	}
}
