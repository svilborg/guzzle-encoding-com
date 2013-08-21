<?php
namespace Gencoding\Guzzle\Encoding\Common;

use Gencoding\Guzzle\Encoding\Common\Exception\EncodingXmlException;

/**
 * Encoding.com Request XML Structure
 */
class EncodingRequest extends \DOMDocument
{

    /**
     * Initalize Request DOM Document
     */
    public function __construct()
    {
        parent::__construct('1.0', 'utf-8');
        $this->formatOutput = true;
    }

    /**
     * Set Query & Auth Params
     *
     * @param string $userid
     *            User Id
     * @param string $userkey
     *            User Key
     * @param string $action
     *            Action Name
     * @return DOMNode
     */
    public function setDomQuery($userid, $userkey, $action)
    {
        $request = $this->appendChild($this->createElement('query'));

        // add action, userid and userkey params
        $userid = $this->createElement('userid', $userid);
        $userkey = $this->createElement('userkey', $userkey);
        $action = $this->createElement('action', $action);

        $request->appendChild($userid);
        $request->appendChild($userkey);
        $request->appendChild($action);

        return $request;
    }
}
