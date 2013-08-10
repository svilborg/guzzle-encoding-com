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
	 * Public constructor.
	 *
	 * @param string            $message Exception message
	 * @param integer           $code    Exception code
	 * @param EncodingResponse    $xmlResponse The XML response
	*/
	public function __construct($xmlResponse) {
		$this->response = $xmlResponse;

		if ($xmlResponse->hasError()) {
			$this->message = $xmlResponse->getErrorMessage();
		}

		parent::__construct($this->message);
	}

	/**
	 * Returns the response for the XML exception.
	 * @return EncodingResponse The response object
	 */
	public function getResponse() {
		return $this->response;
	}
}
