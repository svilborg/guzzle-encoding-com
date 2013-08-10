<?php

namespace Gencoding\Guzzle\Encoding\Common;

use Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException;


/**
 * Encoding.com Response XML Class
 */
class EncodingResponse
{
	/**
	 * The SimpleXMLElement object from the response.
	 * @var SimpleXMLElement
	 */
	protected $xmlElement;

	/**
	 * Public constructor.
	 *
	 * @param SimpleXMLElement  $xmlResponse The XML response
	 */
	public function __construct($xmlString) {
		// try parsing the XML and throw a custom error
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
		return isset($this->xmlElement->error);
	}

	/**
	 * Returns the error value if one is set.
	 * Errors can have an optional value in the XML API response.
	 * @return string The error value in the XML response
	 */
	public function getErrorValue() {
		$errorValue = null;
		if ($this->hasError() && (string) $this->xmlElement->error !== '') {
			$errorValue = (string) $this->xmlElement->error;
		}
		return $errorValue;
	}

	/**
	 * Returns the error type of the error or null
	 * @return string Error code as string
	 */
	public function getErrorType() {
		if ($this->hasError()) {
			$attributes = $this->xmlElement->error->attributes();

			if (isset($attributes->type)) {
				return (string) $attributes->type;
			}
		}
		return null;
	}

	/**
	 * @return string RequestUid of the XML API response.
	 */
	public function getRequestUid() {
		return (string) $this->xmlElement->requestUid;
	}
}
