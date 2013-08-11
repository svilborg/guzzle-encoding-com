<?php
namespace Gencoding\Guzzle\Encoding\Tests;

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;

class EncodingClientTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $this->client = $this->getServiceBuilder()->get('test');
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
            $media = $command->execute();
            echo "<pre>";
            var_dump((string)$media);
            echo "</pre>";
            die();
        } catch (\Exception $e) {

            $this->fail('GetMediaInfo command failed - ' . $e->getMessage());
        }
    }

    // public function testAddMedia() {
    // $command = $this->object->getCommand('AddMedia',
    // array()
    // );
    // try {
    // $media = $command->execute();
    // } catch (Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException $e) {
    // $this->fail('AddMedia command failed - ' . $e->getMessage());
    // }
    // }

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
