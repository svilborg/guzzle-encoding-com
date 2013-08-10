<?php

namespace Gencoding\Guzzle\Encoding\Common\Exception;

use Gencoding\Guzzle\Encoding\Common\EncodingResponse;
use Guzzle\Common\Exception\GuzzleException;

/**
 * Gencoding XML exception
 */
class EncodingXmlException extends \Exception implements GuzzleException
{
	/**
	 * XML content
	 * @var EncodingResponse
	 */
	protected $response;

	/**
	 * Exception message
	 * @var string
	 */
	protected $message = 'Unknown exception';

	/**
	 * XML API response error type
	 * @var string
	 */
	protected $errorType;

	/**
	 * Mapping of XML API error types
	 * @var array
	 */
	protected static $errorTypes = array(
			'xmlparseerror'       => "The submitted XML document is not valid.",
			'dtdparseerror'       => "The submitted XML document doesn't properly follow the DTD."
	);

	/**
	 * Public constructor.
	 *
	 * @param string            $message Exception message
	 * @param integer           $code    Exception code
	 * @param EncodingResponse    $xmlResponse The XML response
	*/
	public function __construct($xmlResponse) {
		$this->response = $xmlResponse;

		if ($xmlResponse->hasError()) {
			$this->message = $xmlResponse->getErrorValue();
		}

		//$this->message = $xmlResponse;

		parent::__construct($this->message);
	}

	/**
	 * Returns the error type.
	 * @return string XML error type
	 */
	public function getErrorType() {
		return $this->errorType;
	}

	/**
	 * @return array All possible error types and associated error messages.
	 */
	public static function getErrorTypes() {
		return static::$errorTypes;
	}

	/**
	 * Returns the response for the XML exception.
	 * @return EncodingResponse The response object
	 */
	public function getResponse() {
		return $this->response;
	}
}
