<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


use Silversurfer7\Sendgrid\Api\MarketingEmail\Exception\InvalidRecipientDataException;

class Emails extends BaseElement {
    const ACTION_BASE_URL = 'newsletter/lists/email/';

    public function add($listIdentifier, array $data) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        if (count($data) > 1000) {
            throw new InvalidRecipientDataException('a maximum of 1000 entries can be added per run');
        }

        foreach ($data as $oneEntry) {
            if (!isset($oneEntry['name'])) {
                throw new InvalidRecipientDataException('recipient has no name set');
            }
            if (!isset($oneEntry['email'])) {
                throw new InvalidRecipientDataException('recipient has no email set');
            }


            foreach ($oneEntry as $key => $value) {
                if (!is_string($key) || empty($key)) {
                    throw new InvalidRecipientDataException('recipient data keys must be a string');
                }

                if (!is_string($value)) {
                    throw new InvalidRecipientDataException('recipient data values must be a string');
                }

            }
        }

        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('list' => $listIdentifier, 'data' => json_encode($data)));

        return $response['inserted'];
    }

    public function get($listIdentifier, array $emailAddresses = array(), $unsubscribed = 0) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        if ($unsubscribed !== 0 && $unsubscribed !== 1) {
            throw new \InvalidArgumentException('unsubscribed must be 0 or 1');
        }

        $data = array(
            'list' => $listIdentifier
        );

        if (!empty($emailAddresses)) {
            $data['email'] = $emailAddresses;
        }

        if ($unsubscribed === 1) {
            $data['unsubscribed'] = 1;
        }

        return $this->apiClient->run(self::ACTION_BASE_URL . 'get', $data);
    }

    public function count($listIdentifier) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }
        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'count', array('list' => $listIdentifier));
        return $result['count'];
    }

    public function delete($listIdentifier, array $emailAdresses) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        if (empty($emailAdresses)) {
            throw new \InvalidArgumentException('email addresses to delete must not be empty');
        }

        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'delete', array('list' => $listIdentifier, 'email' => $emailAdresses));
        return $result['removed'];
    }
}