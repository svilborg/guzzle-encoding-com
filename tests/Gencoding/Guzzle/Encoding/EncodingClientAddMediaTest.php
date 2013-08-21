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
            "source" => "http://localhost/one.mp4",
            "format" => array(
                "output" => "flv",
                "video_codec" => "vp6",
                "audio_bitrate" => "64k"
            )
        ));
        $command->prepare();

        try {
            $result = $command->execute();

            $xml = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<query>
  <userid>xx</userid>
  <userkey>xx</userkey>
  <action>AddMedia</action>
  <source>http://localhost/one.mp4</source>
  <format>
    <output>flv</output>
    <video_codec>vp6</video_codec>
    <audio_bitrate>64k</audio_bitrate>
  </format>
</query>
XML;

            // Request Check
            $this->assertXmlStringEqualsXmlString($xml, $command->getRawXml()
                ->saveXML());

            // Response Checks
            $this->assertFalse($result->hasError());
            $this->assertEquals($result->getXmlString(), $command->getResponseBody(false));

            $resultObject = $result->getXmlElement();

            $this->assertNotEmpty($resultObject->message);
            $this->assertNotEmpty($resultObject->MediaID);
        } catch (\Exception $e) {

            $this->fail('AddMedia command failed - ' . $e->getMessage());
        }
    }

    public function testAddMediaMultiSources()
    {
        $command = $this->client->getCommand('AddMedia', array(
            "source" => array(
                "http://localhost/one.mp4",
                "test://test"
            ),
            "format" => array(
                "output" => "flv",
                "video_codec" => "vp6",
                "audio_bitrate" => "64k"
            )
        ));
        $this->setMockResponse($this->client, 'AddMedia');

        $command->prepare();

        try {
            $result = $command->execute();

            $xml = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<query>
  <userid>xx</userid>
  <userkey>xx</userkey>
  <action>AddMedia</action>
  <source>http://localhost/one.mp4</source>
  <source>test://test</source>
  <format>
    <output>flv</output>
    <video_codec>vp6</video_codec>
    <audio_bitrate>64k</audio_bitrate>
  </format>
</query>
XML;

            // Request Check
            $this->assertXmlStringEqualsXmlString($xml, $command->getRawXml()
                ->saveXML());

            $this->assertFalse($result->hasError());
            $this->assertEquals($result->getXmlString(), $command->getResponseBody(false));

            $resultObject = $result->getXmlElement();

            $this->assertNotEmpty($resultObject->message);
            $this->assertNotEmpty($resultObject->MediaID);
        } catch (\Exception $e) {

            $this->fail('AddMedia command failed - ' . $e->getMessage());
        }
    }

    public function testAddMediaMultiDestinations()
    {
        $command = $this->client->getCommand('AddMedia', array(
            "source" => array(
                "http://localhost/one.mp4",
                "test://test"
            ),
            "format" => array(
                "output" => "flv",
                "video_codec" => "vp6",
                "audio_bitrate" => "64k",
                "destination" => array(
                    "ftp://test@dest.com/",
                    "ftp://test2@dest2.com/"
                ),
                "metadata" => array(
                    'title' => "Title"
                )
            )
        ));
        $this->setMockResponse($this->client, 'AddMedia');

        $command->prepare();

        try {
            $result = $command->execute();

            $xml = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<query>
  <userid>xx</userid>
  <userkey>xx</userkey>
  <action>AddMedia</action>
  <source>http://localhost/one.mp4</source>
  <source>test://test</source>
  <format>
    <output>flv</output>
    <video_codec>vp6</video_codec>
    <audio_bitrate>64k</audio_bitrate>
    <destination>ftp://test@dest.com/</destination>
    <destination>ftp://test2@dest2.com/</destination>
    <metadata>
        <title>Title</title>
    </metadata>
  </format>
</query>
XML;

            // Request Check
            $this->assertXmlStringEqualsXmlString($xml, $command->getRawXml()
                ->saveXML());

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
        $this->client = null;

        parent::tearDown();
    }
}
