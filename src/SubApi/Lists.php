<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


class Lists extends BaseElement {

    const ACTION_BASE_URL = 'newsletter/lists/';

    public function add($listIdentifier, $columnName = '') {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        if (!is_string($columnName)) {
            throw new \InvalidArgumentException('list name must be of type string');
        }

        $data = array('list' => $listIdentifier);
        if (!empty($columnName)) {
            $data['name'] = $columnName;
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'add', $data);
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    public function rename($listIdentifier, $newListName) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        if (!is_string($newListName) || empty($newListName)) {
            throw new \InvalidArgumentException('new list name must be of type string');
        }

        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'edit', array('list' => $listIdentifier, 'newlist' => $newListName));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    public function getAll() {
        return $this->apiClient->run(self::ACTION_BASE_URL . 'get', array());
    }

    public function exists($listIdentifier) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'get', array('list' => $listIdentifier));
        if (count($result) == 0) {
            return false;
        }

        foreach ($result as $one) {
            if ($one['list'] == $listIdentifier) {
                return true;
            }
        }
        return false;
    }

    public function delete($listIdentifier) {
        if (!is_string($listIdentifier) || empty($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'delete', array('list' => $listIdentifier));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

} 