<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


class Recipients extends BaseElement {
    const ACTION_BASE_URL = 'newsletter/recipients/';

    public function add($listIdentifier, $uniqueEmailIdentifier) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string and must not be empty');
        }

        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string and must not be empty');
        }

        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('list' => $listIdentifier, 'name' => $uniqueEmailIdentifier));

        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    public function getAllListsAssignedToMarketingEmail($uniqueEmailIdentifier) {
        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string');
        }

        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'get', array('name' => $uniqueEmailIdentifier));
        $returnValue = array();
        foreach ($result as $one) {
            $returnValue[] = $one['list'];
        }
        return $returnValue;
    }

    public function deleteListFromMarketingEmail($listIdentifier, $uniqueEmailIdentifier) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string and must not be empty');
        }

        if (!is_string($uniqueEmailIdentifier) || empty($uniqueEmailIdentifier)) {
            throw new \InvalidArgumentException('email name must be of type string and must not be empty');
        }

        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'delete', array('list' => $listIdentifier, 'name' => $uniqueEmailIdentifier));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

}