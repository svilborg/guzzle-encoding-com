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

        // public function testGetMediaInfo()
        // {
        // $this->setMockResponse($this->client, 'AddMedia');

    // $command = $this->client->getCommand('AddMedia', array(
        // "mediaid" => 19003866
        // ));
        // $command->prepare();

    // try {
        // $result = $command->execute();

    // $this->assertFalse($result->hasError());
        // $this->assertEquals($result->getXmlString(), $command->getResponseBody(false));

    // $resultObject = $result->getXmlElement();

    // $this->assertNotEmpty($resultObject->size);
        // $this->assertNotEmpty($resultObject->duration);
        // $this->assertNotEmpty($resultObject->bitrate);
        // } catch (\Exception $e) {

    // $this->fail('GetMediaInfo command failed - ' . $e->getMessage());
        // }
        // }


    public function testAddMedia()
    {
        $command = $this->object->getCommand('AddMedia', array());
        try {
            $media = $command->execute();
        } catch (Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException $e) {
            $this->fail('AddMedia command failed - ' . $e->getMessage());
        }
    }

    // public function testGetMediaList() {
    // $command = $this->object->getCommand('GetMediaList',
    // array()
    // );
    // try {
    // $media = $command->execute();
    // echo "<pre>";
    // var_dump($media);
    // echo "</pre>";
    // } catch (Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException $e) {
    // $this->fail('GetMediaList command failed - ' . $e->getMessage());
    // }
    // }

    // public function testGetStatusList() {

    // $command = $this->object->getCommand('GetStatus',
    // array("mediaid" => 19003866)
    // );

    // try {
    // $media = $command->execute();

    // // echo "<pre>";
    // // var_dump($media);
    // // echo "</pre>";
    // // die;

    // } catch (\Exception $e) {

    // $this->fail('GetStatus command failed - ' . $e->getMessage());
    // }
    // }
    protected function tearDown()
    {
        parent::tearDown();
    }
}
