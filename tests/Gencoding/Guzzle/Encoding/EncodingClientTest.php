<?php
namespace Gencoding\Guzzle\Encoding\Tests;

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;

class EncodingClientTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $this->client = $this->getServiceBuilder()->get('test');
    }

    public function testEmpty()
    {
        $this->assertTrue(true);
    }

    public function testMissingParamsException()
    {
        $this->setExpectedException("InvalidArgumentException");

        $object = EncodingClient::factory();
    }

    public function testWrongAuthException()
    {
        $this->setExpectedException("Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException");

        $this->setMockResponse($this->client, 'ErrorAuth');

        $command = $this->client->getCommand('AddMedia', array());
        $command->prepare();

        $media = $command->execute();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
