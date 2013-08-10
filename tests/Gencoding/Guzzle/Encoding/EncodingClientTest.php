<?php

use Gencoding\Guzzle\Encoding\EncodingClient;

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

	public function testFactoryException() {
		$this->setExpectedException("InvalidArgumentException");

		$object = EncodingClient::factory();
	}

	public function testAddMedia() {

		$command = $this->object->getCommand('AddMedia',
				array()
		);

		try {
			$media = $command->execute();
		} catch (\Exception $e) {
			$this->fail('AddMedia command failed');
		}
		// echo "<pre>";
		// var_dump($media);
		// echo "</pre>";die;
		// 		$this->assertNotNull($user['id']);
	}

	protected function tearDown() {
		parent::tearDown();
	}
}
