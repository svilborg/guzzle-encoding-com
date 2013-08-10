<?php

namespace Gencoding\Guzzle\Encoding\Command;


use Gencoding\Guzzle\Encoding\Common;
use Gencoding\Guzzle\Encoding\Common\EncodingResponse;
use Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException;

use Guzzle\Service\Command\AbstractCommand;
use Guzzle\Service\Exception\CommandException;

/**
 * Abstract command implementing XML calls and responses
 */
abstract class XmlAbstractCommand extends AbstractCommand
{
	/**
	 * The XML object used as body in the request
	 * @var DOMDocument
	 */
	protected $rawXml;

	/**
	 * Create the result of the command after the request has been completed.
	 * We expect the response to be an XML, so this method converts the repons
	 * to a SimpleXMLElement object. Also, exceptions are thrown accordingly.
	 */
	protected function process()
	{
		// Uses the response object by default
		$this->result = $this->getRequest()->getResponse();

		$contentType = $this->result->getContentType();

		if (stripos($contentType, 'xml') === false) {
			throw new EncodingXmlException('The Response is not in a valid XML Content Type.');
		}

		$body = trim($this->result->getBody(true));
		$this->result = new EncodingResponse($body);

		$this->handleResponseErrors($this->result);
	}

	/**
	 * Prepares the request to the API.
	 */
	protected function build()
	{
		$this->rawXml = $this->buildXML();
		$this->request = $this->client->post(null, null, $this->rawXml->saveXML());
	}

	/**
	 * Builds the XML for the request body.
	 * @return DOMDocument XML in DOMDocument format
	 */
	public function buildXML() {
		$xml = new \DOMDocument('1.0', 'utf-8');
		$xml->formatOutput = true;

		$request = $xml->appendChild($xml->createElement('query'));

		// add action, userid and userkey params
		$userid = $xml->createElement('userid', $this->client->getConfig('userid'));
		$userkey = $xml->createElement('userkey', $this->client->getConfig('userkey'));
		$action  = $xml->createElement('action', $this->getName());

		$request->appendChild($userid);
		$request->appendChild($userkey);
		$request->appendChild($action);

		$params = $request->appendChild($xml->createElement('parameters'));

		// add parameters
		foreach ($this->getOperation()->getParams() as $name => $arg) {
			if ($this->get($name) === true) {
				$params->appendChild($xml->createElement($name));
			} else if (!is_null($this->get($name)) && $this->get($name) !== false) {
				$params->appendChild($xml->createElement($name, $this->get($name)));
			}
		}

		return $xml;
	}

	/**
	 * Checks the XML response for errors.
	 * @param  EncodingResponse $xml XML response
	 */
	protected function handleResponseErrors($xmlResponse) {
		if ($xmlResponse->hasError()) {
			throw new EncodingXmlException($xmlResponse);
		}
	}

	/**
	 * {@inheritdoc}
	 * @return EncodingResponse
	 */
	public function getResult()
	{
		return parent::getResult();
	}

	/**
	 * Get the raw XML object
	 *
	 * @return DOMDocument
	 * @throws CommandException
	 */
	public function getRawXml()
	{
		if (!$this->isPrepared()) {
			throw new CommandException('The command must be prepared before retrieving the request XML');
		}

		return $this->rawXml;
	}

	/**
	 * Returns the response body, by default with
	 * encoded HTML entities as string.
	 *
	 * @param  boolean $encodeEntities Encode the HTML entities on the body?
	 * @return string  Response body
	 */
	public function getResponseBody($encodeEntities = true) {
		$body = (string) $this->getResponse()->getBody();

		if ($encodeEntities) {
			return htmlentities($body);
		}

		return $body;
	}
}