<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


class MarketingEmails extends BaseElement {
    const ACTION_BASE_URL = 'newsletter/';

    public function add($senderIdentity, $uniqueEmailIdentifier, $subject, $textPart, $htmlPart) {
        if (!is_string($senderIdentity) || empty($senderIdentity)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string');
        }

        if (!is_string($subject) || empty($subject)) {
            throw new \InvalidArgumentException('subject must be of type string');
        }

        if (!is_string($textPart) || empty($textPart)) {
            throw new \InvalidArgumentException('text part must be of type string');
        }

        if (!is_string($htmlPart) || empty($htmlPart)) {
            throw new \InvalidArgumentException('html part must be of type string');
        }

        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('identity' => $senderIdentity, 'name' => $uniqueEmailIdentifier, 'subject' => $subject, 'text' => $textPart, 'html' => $htmlPart));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    public function edit($senderIdentity, $currentEmailIdentifier, $newUniqueEmailIdentifier, $newSubject, $newTextPart, $newHtmlPart) {
        if (!is_string($senderIdentity) || empty($senderIdentity)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        if (!is_string($currentEmailIdentifier) || empty($currentEmailIdentifier)) {
            throw new \InvalidArgumentException('curent email identifier name must be of type string');
        }

        if (!is_string($newUniqueEmailIdentifier) || empty($newUniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email identifier must be of type string');
        }

        if (!is_string($newSubject) || empty($newSubject)) {
            throw new \InvalidArgumentException('subject must be of type string');
        }

        if (!is_string($newTextPart) || empty($newTextPart)) {
            throw new \InvalidArgumentException('text part must be of type string');
        }

        if (!is_string($newHtmlPart) || empty($newHtmlPart)) {
            throw new \InvalidArgumentException('html part must be of type string');
        }

        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'edit', array('identity' => $senderIdentity, 'name' => $currentEmailIdentifier, 'newname' => $newUniqueEmailIdentifier, 'subject' => $newSubject, 'text' => $newTextPart, 'html' => $newHtmlPart));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }


    public function get($uniqueEmailIdentifier) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email identifier name must be of type string');
        }

        return $this->apiClient->run(self::ACTION_BASE_URL . 'get', array('name' => $uniqueEmailIdentifier));
    }

    public function getAll() {
        return $this->apiClient->run(self::ACTION_BASE_URL . 'list', array());
    }

    public function exists($uniqueEmailIdentifier) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email identifier name must be of type string');
        }

        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'list', array('name' => $uniqueEmailIdentifier));

        if (count($result) == 0) {
            return false;
        }

        foreach ($result as $one) {
            if ($one['name'] == $uniqueEmailIdentifier) {
                return true;
            }
        }
        return false;
    }

    public function delete($uniqueEmailIdentifier) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email identifier name must be of type string');
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'delete', array('name' => $uniqueEmailIdentifier));

        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }
}