<?php
namespace Gencoding\Guzzle\Encoding\Tests\Common;

use Gencoding\Guzzle\Encoding\EncodingClient;
use Gencoding\Guzzle\Encoding\Common\Exception;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;

class EncodingResponseTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testCantParseException()
    {
        $this->setExpectedException("Exception");
        $object = new EncodingResponse("");
    }

    public function testSuccess()
    {
        // $this->setExpectedException("Exception");
        $object = new EncodingResponse('<?xml version="1.0"?><response><message>OK</message></response>');

        $this->assertFalse($object->hasError());
        $this->assertNull($object->getErrorMessage());
        $this->assertNotEmpty($object->getXmlElement());
        $this->assertNotEmpty($object->getXmlString());
        $this->assertNotEmpty((string) $object);
    }

    // public function testWrongAuthException()
    // {
    // }
    protected function tearDown()
    {
        parent::tearDown();
    }
}
