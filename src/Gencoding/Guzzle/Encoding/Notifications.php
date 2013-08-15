<?php
namespace Gencoding\Guzzle\Encoding;

/**
 * Notification Parser
 */
class Notifications
{

    /**
     * Parse the notifications
     *
     * @throws \Exception
     * @return SimpleXMLElement
     */
    public function parse()
    {
        $notification = (isset($_POST) && isset($_POST["xml"])) ? $_POST["xml"] : null;

        if (! $notification) {
            throw new \Exception('Notification error', 5000);
        }
        return new \SimpleXMLElement($notification);
    }
}
