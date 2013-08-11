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
     * Exception message
     *
     * @var string
     */
    protected $message = 'Unknown exception';

    /**
     * Public constructor.
     *
     * @param EncodingResponse $xmlResponse
     *            The XML response
     */
    public function __construct($xmlResponse)
    {
        if ($xmlResponse->hasError()) {
            $this->message = $xmlResponse->getErrorMessage();
        }

        parent::__construct($this->message);
    }
}
