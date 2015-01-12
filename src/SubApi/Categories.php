<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


class Categories extends BaseElement {

    const ACTION_BASE_URL = 'newsletter/category/';

    /**
     * @param $category
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function create($category) {
        if (!is_string($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $this->apiClient->run(self::ACTION_BASE_URL . 'create', array('category' => $category));
        return true;
    }

    /**
     * add a category to a marketing email
     * @param $category
     * @param $marketingEmailIdentifier
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function add($category, $marketingEmailIdentifier) {
        if (!is_string($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }

        if (!is_string($marketingEmailIdentifier)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('category' => $category));
        return true;
    }

    /**
     * remove a category from a marketing Email
     * @param $category
     * @param $marketingEmailIdentifier
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function remove($category, $marketingEmailIdentifier) {
        if (!is_string($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }

        if (!is_string($marketingEmailIdentifier)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $this->apiClient->run(self::ACTION_BASE_URL . 'remove', array('category' => $category, 'name' => $marketingEmailIdentifier));
        return true;
    }

    /**
     * remove all categories from a marketing email
     * @param $marketingEmailIdentifier
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function removeAll($marketingEmailIdentifier) {
        if (!is_string($marketingEmailIdentifier)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $this->apiClient->run(self::ACTION_BASE_URL . 'remove', array('name' => $marketingEmailIdentifier));
        return true;
    }

    /**
     * list all categories
     * @return mixed|null
     */
    public function listAll() {
        return $this->apiClient->run(self::ACTION_BASE_URL . 'list', array('category' => $category));
    }

    /**
     * @param $category
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function exists($category) {
        if (!is_string($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'list', array('category' => $category));
        return !empty($result);
    }


} 