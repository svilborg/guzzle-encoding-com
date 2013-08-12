<?php
namespace Gencoding\Guzzle\Encoding\Tests;

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;

class EncodingClientAddMediaTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $this->client = $this->getServiceBuilder()->get('test');
    }

    public function testAddMedia()
    {
        $command = $this->client->getCommand('AddMedia', array());
        $this->setMockResponse($this->client, 'AddMedia');

        $command = $this->client->getCommand('AddMedia', array(
            "source" => "http://localhost/test.mp4",
            "format" => array(
                "output" => "flv",
                "video_codec" => "vp6",
                "audio_bitrate" => "64k"
            )
        ));
        $command->prepare();

        try {
            $result = $command->execute();

            $this->assertFalse($result->hasError());
            $this->assertEquals($result->getXmlString(), $command->getResponseBody(false));

            $resultObject = $result->getXmlElement();

            $this->assertNotEmpty($resultObject->message);
            $this->assertNotEmpty($resultObject->MediaID);
        } catch (\Exception $e) {

            $this->fail('AddMedia command failed - ' . $e->getMessage());
        }
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
