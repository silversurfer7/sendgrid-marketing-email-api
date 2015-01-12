<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


class Schedule extends BaseElement {
    const ACTION_BASE_URL = 'newsletter/schedule/';

    public function sendMarketingEmailNow($uniqueEmailIdentifier) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string');
        }

        $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('name' => $uniqueEmailIdentifier));
        return true;
    }

    public function sendMarketingEmailInMinutes($uniqueEmailIdentifier, $minutesToWait) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string');
        }

        if (!is_numeric($minutesToWait) || $minutesToWait <= 0) {
            throw new \InvalidArgumentException('minutes to wait must be a positiv integer');
        }


        $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('name' => $uniqueEmailIdentifier, 'after' => $minutesToWait));
        return true;
    }


    public function sendMarketingEmailAt($uniqueEmailIdentifier, \DateTime $sendDate) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string');
        }

        if ($sendDate->getTimestamp() <= time()) {
            throw new \InvalidArgumentException('send date is in the past');
        }


        $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('name' => $uniqueEmailIdentifier, 'at' => $sendDate->format('c')));
        return true;
    }

    public function get($uniqueEmailIdentifier) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string');
        }

        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'get', array('name' => $uniqueEmailIdentifier));
        if (isset($result['date'])) {
            return new \DateTime($result['date']);
        }
        return null;
    }



    public function delete($uniqueEmailIdentifier) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string');
        }

        $this->apiClient->run(self::ACTION_BASE_URL . 'delete', array('name' => $uniqueEmailIdentifier));
        return true;
    }
} 