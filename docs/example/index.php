<?php
use Gencoding\Guzzle\Encoding\EncodingClient;

include_once '../../vendor/autoload.php';

$s = EncodingClient::factory(array(
		'base_url' => 'http://twitter.com',
		'userid'   => '1',
		'userkey'  => 'test'
));

try {

	$command = $s->getCommand('AddMedia', array(
			'p1'     => 20
	));

	$command->prepare();

} catch (Exception $e) {
	var_dump($e->getMessage());
}




echo "<pre>";
var_dump($command->getRawXml()->saveXML());
echo "</pre>";die;
// $r = $s->execute($command);

// echo "<pre>";
// var_dump($r);
// echo "</pre>";
// die;