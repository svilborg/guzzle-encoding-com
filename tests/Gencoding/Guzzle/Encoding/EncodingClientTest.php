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

    public function testWrongXmlException()
    {
        $this->setExpectedException("Exception");

        $this->setMockResponse($this->client, 'WrongXml');

        $command = $this->client->getCommand('AddMedia', array());
        $command->prepare();

        $media = $command->execute();
    }

    public function testWrongContentTypeException()
    {
        $this->setExpectedException("Exception");

        $this->setMockResponse($this->client, 'WrongContentType');

        $command = $this->client->getCommand('AddMedia', array());
        $command->prepare();

        $media = $command->execute();
    }

    public function testNotPreparedException()
    {
        $this->setExpectedException("Guzzle\Service\Exception\CommandException");
        $this->setMockResponse($this->client, 'AddMedia');

        $command = $this->client->getCommand('AddMedia', array());

        $command->getRawXml();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
