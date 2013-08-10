<?php
function sendRequest($xml)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://manage.encoding.com/");
	curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=" . urlencode($xml));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	return curl_exec($ch);
}

// Begin processing User's POST
if(!empty($_POST['source']))
{
	// Preparing XML request

	// Main fields
	$req = new SimpleXMLElement('<?xml version="1.0"?><query></query>');
	$req->addChild('userid', MY_ID);
	$req->addChild('userkey', MY_KEY);
	$req->addChild('action', 'AddMedia');
	$req->addChild('source', $_POST['source']);

	$formatNode = $req->addChild('format');
	// Format fields
	foreach($_POST['format'] as $property => $value)
	{
		if ($value !== '')
			$formatNode->addChild($property, $value);
	}

	// Sending API request
	$res = sendRequest($req->asXML());

	try
	{
		// Creating new object from response XML
		$response = new SimpleXMLElement($res);

		// If there are any errors, set error message
		if(isset($response->errors[0]->error[0])) {
			$error = $response->errors[0]->error[0] . '';
		}
		else
			if ($response->message[0]) {
			// If message received, set OK message
		$message = $response->message[0] . '';
		}
	}
	catch(Exception $e)
	{
		// If wrong XML response received
		$error = $e->getMessage();
	}

	// Displaying error if any
	if (!empty($error)) {
		echo '<div class="error">' . htmlspecialchars($error) . '</div>';
	}

	// Displaying message
	if (!empty($message)) {
		echo '<div class="message">' . htmlspecialchars($message) . '</div>';
	}
	exit;
}