<?php
namespace Gencoding\Guzzle\Encoding\Command;

use Gencoding\Guzzle\Encoding\Common;
use Gencoding\Guzzle\Encoding\Common\EncodingRequest;
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
     *
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
            throw new \Exception('The Response is not in a valid XML Content Type.');
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

        $this->client->setDefaultOption('headers', array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        ));

        $this->request = $this->client->post(null, null, array(
            "xml" => ($this->rawXml->saveXML())
        ));
    }

    /**
     * Builds the XML for the request body.
     *
     * @return EncodingRequest XML in DOMDocument format
     */
    public function buildXML()
    {
        $xml = new EncodingRequest();

        $request = $xml->setDomQuery($this->client->getConfig('userid'), $this->client->getConfig('userkey'), $this->getName());

        foreach ($this->getOperation()->getParams() as $name => $arg) {

            if ($this->get($name) === true) {
                $request->appendChild($xml->createElement($name));
            } else {
                if (! is_null($this->get($name)) && $this->get($name) !== false) {

                    if (! is_array($this->get($name))) {
                        // Non Array Type - String, Integer, etc ..

                        $request->appendChild($xml->createElement($name, $this->get($name)));
                    } else {

                        if ($name == "source") {
                            // Build "Flat" Array to XML

                            foreach ($this->get($name) as $key => $value) {
                                $request->appendChild($xml->createElement($name, $value));
                            }
                        } else {
                            // Build Array to XML

                            $arrayRoot = $request->appendChild($xml->createElement($name));

                            foreach ($this->get($name) as $key => $value) {

                                if (! is_array($value)) {
                                    $arrayRoot->appendChild($xml->createElement($key, $value));
                                } else {
                                    if ($key == "destination") {
                                        // Build "Flat" Array to XML in a sub Element
                                        foreach ($value as $subValue) {
                                            $arrayRoot->appendChild($xml->createElement($key, $subValue));
                                        }
                                    } else {
                                        $arraySubRoot = $arrayRoot->appendChild($xml->createElement($key));

                                        foreach ($value as $subKey => $subValue) {
                                            $arraySubRoot->appendChild($xml->createElement($subKey, $subValue));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $xml;
    }

    /**
     * Checks the XML response for errors.
     *
     * @param EncodingResponse $xml
     *            XML response
     */
    protected function handleResponseErrors($xmlResponse)
    {
        if ($xmlResponse->hasError()) {
            throw new EncodingXmlException($xmlResponse);
        }
    }

    /**
     *
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
        if (! $this->isPrepared()) {
            throw new CommandException('The command must be prepared before retrieving the request XML');
        }

        return $this->rawXml;
    }

    /**
     * Returns the response body, by default with
     * encoded HTML entities as string.
     *
     * @param boolean $encodeEntities
     *            Encode the HTML entities on the body
     * @return string Response body
     */
    public function getResponseBody($encodeEntities = true)
    {
        $body = (string) $this->getResponse()->getBody();

        if ($encodeEntities) {
            return htmlentities($body);
        }

        return $body;
    }
}
