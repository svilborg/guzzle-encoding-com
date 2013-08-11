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
     *
     * @var SimpleXMLElement
     */
    protected $xmlElement;

    /**
     * Constructor.
     *
     * @param SimpleXMLElement $xmlResponse
     *            The XML response
     */
    public function __construct($xmlString)
    {
        try {
            $this->xmlElement = new \SimpleXMLElement($xmlString);
        } catch (\Exception $e) {
            throw new \Exception('Could not parse the XML response.');
        }
    }

    /**
     * Checks if the XML response contains an error
     *
     * @return boolean True if terror
     */
    public function hasError()
    {
        return isset($this->xmlElement->errors);
    }

    /**
     *
     * @return \Gencoding\Guzzle\Encoding\Common\SimpleXMLElement
     */
    public function getXmlElement()
    {
        return $this->xmlElement;
    }

    /**
     * XML Result as string
     *
     * @return string
     */
    public function getXmlString()
    {
        return $this->xmlElement ? trim($this->xmlElement->saveXML()) : "";
    }

    /**
     * Returns the error message
     *
     * @return string Error message
     */
    public function getErrorMessage()
    {
        $errorValue = null;
        if ($this->hasError()) {
            $errorValue = (string) $this->xmlElement->errors->error;
        }
        return $errorValue;
    }

    /**
     * XML Result as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getXmlString();
    }
}
