<?php
use Gencoding\Guzzle\Encoding\EncodingClient;

include_once '../../vendor/autoload.php';

$s = EncodingClient::factory(array(
    'base_url' => 'http://localhost',
    'userid' => '1',
    'userkey' => 'test'
));

try {

    $command = $s->getCommand('AddMedia', array(
        'p1' => 20
    ));

    $command->prepare();
} catch (Exception $e) {
    var_dump($e->getMessage());
}

out($command->getRawXml()->saveXML());
die();

function out($str)
{
    echo "\n";
    echo ($str);
    echo "\n";
}
// $r = $s->execute($command);