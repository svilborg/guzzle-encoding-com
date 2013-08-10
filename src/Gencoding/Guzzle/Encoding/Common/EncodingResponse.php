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

	/**
	 * Constructor.
	 *
	 * @param SimpleXMLElement $xmlResponse The XML response
	 */
	public function __construct($xmlString) {
		try {
			$this->xmlElement = new \SimpleXMLElement($xmlString);

		} catch (\Exception $e) {
			throw new EncodingXmlException('Could not parse the XML response.');
		}
	}

	/**
	 * Checks whether the XML response contains any errors.
	 * @return boolean True if the XML response has errors, false else.
	 */
	public function hasError() {
		return isset($this->xmlElement->errors);
	}

	/**
	 * Returns the error value if one is set.
	 * Errors can have an optional value in the XML API response.
	 * @return string The error value in the XML response
	 */
	public function getErrorValue() {
		$errorValue = null;
		if ($this->hasError() && (string) $this->xmlElement->errors !== '') {
			$errorValue = (string)$this->xmlElement->errors->errorr;
		}
		return $errorValue;
	}
}
