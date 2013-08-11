<?php
namespace Gencoding\Guzzle\Encoding\Tests;

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;

class EncodingClientGetMediaInfoTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $this->client = $this->getServiceBuilder()->get('test');
    }

    public function testGetMediaInfoException()
    {
        $this->setExpectedException("Guzzle\Service\Exception\ValidationException");

        $this->setMockResponse($this->client, 'GetMediaInfo');

        $command = $this->client->getCommand('GetMediaInfo', array());
        $command->prepare();

        $media = $command->execute();
    }

    public function testGetMediaInfo()
    {
        $this->setMockResponse($this->client, 'GetMediaInfo');

        $command = $this->client->getCommand('GetMediaInfo', array(
            "mediaid" => 19003866
        ));
        $command->prepare();

        try {
            $result = $command->execute();

            $this->assertFalse($result->hasError());
            $this->assertEquals($result->getXmlString(), $command->getResponseBody(false));

            $resultObject = $result->getXmlElement();

            $this->assertNotEmpty($resultObject->size);
            $this->assertNotEmpty($resultObject->duration);
            $this->assertNotEmpty($resultObject->bitrate);
        } catch (\Exception $e) {

            $this->fail('GetMediaInfo command failed - ' . $e->getMessage());
        }
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
