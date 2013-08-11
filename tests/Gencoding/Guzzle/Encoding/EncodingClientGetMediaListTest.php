<?php
namespace Gencoding\Guzzle\Encoding\Tests;

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;

class EncodingClientGetMediaListTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $this->client = $this->getServiceBuilder()->get('test');
    }

    public function testGetMediaList()
    {
        $command = $this->client->getCommand('GetMediaList', array());
        $this->setMockResponse($this->client, 'GetMediaList');

        $command = $this->client->getCommand('GetMediaList', array(
            "source" => "http://localhost/test.mp4"
        ));
        $command->prepare();

        try {
            $result = $command->execute();

            $this->assertFalse($result->hasError());
            $this->assertEquals($result->getXmlString(), $command->getResponseBody(false));

            $resultObject = $result->getXmlElement();

            $this->assertNotEmpty($resultObject->media);
        } catch (\Exception $e) {

            $this->fail('GetMediaList command failed - ' . $e->getMessage());
        }
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
