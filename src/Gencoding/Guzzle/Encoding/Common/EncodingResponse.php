<?php

namespace Gencoding\Guzzle\Encoding\Common;

use Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException;


/**
 * Encoding.com Response XML Class
 */
class EncodingResponse
{
	/**
	 * The SimpleXMLElement Response Object
	 * @var SimpleXMLElement
	 */
	protected $xmlElement;

	protected $xmlString;

	/**
	 * Constructor.
	 *
	 * @param SimpleXMLElement $xmlResponse The XML response
	 */
	public function __construct($xmlString) {

		$this->xmlString = $xmlString;

		try {
			$this->xmlElement = new \SimpleXMLElement($xmlString);

		} catch (\Exception $e) {
			throw new EncodingXmlException('Could not parse the XML response.');
		}
	}

	public function  getXml () {
		return $this->xmlString;
	}

	/**
	 * Checks if the XML response contains an error
	 * @return boolean True if terror
	 */
	public function hasError() {
		return isset($this->xmlElement->errors);
	}

	/**
	 * Returns the error message
	 * @return string Error message
	 */
	public function getErrorMessage() {
		$errorValue = null;
		if ($this->hasError() ) {
			$errorValue = (string)$this->xmlElement->errors->error;
		}
		return $errorValue;
	}
}
