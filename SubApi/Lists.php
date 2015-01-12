<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


class Lists extends BaseElement {

    const ACTION_BASE_URL = 'newsletter/lists/';

    public function add($listIdentifier, $listName = '') {
        if (!is_string($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        if (!is_string($listName)) {
            throw new \InvalidArgumentException('list name must be of type string');
        }

        $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('list' => $listIdentifier, 'name' => $listName));
        return true;
    }

    public function rename($listIdentifier, $newListName) {
        if (!is_string($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        if (!is_string($newListName)) {
            throw new \InvalidArgumentException('new list name must be of type string');
        }

        $this->apiClient->run(self::ACTION_BASE_URL . 'edit', array('list' => $listIdentifier, 'newlist' => $newListName));
        return true;
    }

    public function getAll() {
        return $this->apiClient->run(self::ACTION_BASE_URL . 'get', array());
    }

    public function exists($listIdentifier) {
        if (!is_string($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }

        return $this->apiClient->run(self::ACTION_BASE_URL . 'get', array('list' => $listIdentifier));
    }

    public function delete($listIdentifier) {
        if (!is_string($listIdentifier)) {
            throw new \InvalidArgumentException('list identifier must be of type string');
        }
        return $this->apiClient->run(self::ACTION_BASE_URL . 'delete', array('list' => $listIdentifier));
    }

} 