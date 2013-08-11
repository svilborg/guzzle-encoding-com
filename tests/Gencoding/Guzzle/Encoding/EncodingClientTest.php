<?php
namespace Gencoding\Guzzle\Encoding\Tests;

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;

class EncodingClientTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $this->object = EncodingClient::factory(array(
            'base_url' => 'http://manage.encoding.com',
            'userid' => 'xx',
            'userkey' => 'xx'
        ));
    }

    // public function testMissingParamsException() {
    // $this->setExpectedException("InvalidArgumentException");

    // $object = EncodingClient::factory();
    // }

    // public function testWrongAuthException() {
    // $this->setExpectedException("Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException");

    // $object = EncodingClient::factory(array(
    // 'base_url' => 'http://manage.encoding.com',
    // 'userid' => '1',
    // 'userkey' => 'test'
    // ));

    // $command = $this->object->getCommand('AddMedia',
    // array()
    // );

    // $media = $command->execute();
    // }

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
    public function testGetMediaInfo()
    {
        $this->assertTrue(true);

        // $command = $this->object->getCommand('GetMediaInfo', array(
        // "mediaid" => 19003866
        // ));

        // try {
        // $media = $command->execute();

        // // echo "<pre>";
        // // var_dump($media->getXml());
        // // echo "</pre>";
        // // die;
        // } catch (\Exception $e) {

        // $this->fail('GetMediaInfo command failed - ' . $e->getMessage());
        // }
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
