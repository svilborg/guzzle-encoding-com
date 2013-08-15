<?php
namespace Gencoding\Guzzle\Encoding\Tests;

use Gencoding\Guzzle\Encoding\Notifications;

class NotificationsTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $this->notification = new Notifications();
    }

    public function testMissingNotificationException()
    {
        $this->setExpectedException("Exception");

        $this->notification->parse();
    }

    public function testEmptyException()
    {
        $this->setExpectedException("Exception");
        $_POST["xml"] = "";

        $this->notification->parse();
    }

    public function testWrongException()
    {
        $this->setExpectedException("Exception");

        $_POST["xml"] = "<xml//";

        $this->notification->parse();
    }

    public function testSuccess()
    {
        $xml = <<<XML
<?xml version="1.0"?>
<result>
	<mediaid>888</mediaid>
	<source>http://some.com/video.mov</source>
	<status>Finished</status>
	<description>Video</description>
	<encodinghost>http://manage.encoding.com/</encodinghost>
	<format>
		<taskid>12345</taskid>
		<output>3gp</output>
		<status>Finished</status>
		<destination>http://encoding.com.result.s3.amazonaws.com/video_12345.3gp</destination>
	</format>
</result>
XML;

        $_POST["xml"] = $xml;

        $result = $this->notification->parse();

        $this->assertEquals(simplexml_load_string($xml), $result);
        $this->assertXmlStringEqualsXmlString($xml, $result->saveXML());

        $this->assertEquals(888, (string) $result->mediaid);
        $this->assertEquals("Finished", (string) $result->status);
    }

    protected function tearDown()
    {
        unset($_POST);
        parent::tearDown();
    }
}
