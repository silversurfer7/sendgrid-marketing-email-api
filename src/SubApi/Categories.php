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
        if (!is_string($category) || empty($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'create', array('category' => $category));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
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
        if (!is_string($category) || empty($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }

        if (!is_string($marketingEmailIdentifier) || empty($marketingEmailIdentifier)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'add', array('category' => $category, 'name' => $marketingEmailIdentifier));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
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
        if (!is_string($category) || empty($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }

        if (!is_string($marketingEmailIdentifier) || empty($marketingEmailIdentifier)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'remove', array('category' => $category, 'name' => $marketingEmailIdentifier));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    /**
     * remove all categories from a marketing email
     * @param $marketingEmailIdentifier
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function removeAll($marketingEmailIdentifier) {
        if (!is_string($marketingEmailIdentifier) || empty($marketingEmailIdentifier)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'remove', array('name' => $marketingEmailIdentifier));
        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    /**
     * list all categories
     * @return array|null
     */
    public function listAll() {
        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'list', array());
        $returnValue = array();
        foreach ($result as $one) {
            $returnValue[] = $one['category'];
        }
        return $returnValue;
    }

    /**
     * @param $category
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function exists($category) {
        if (!is_string($category) || empty($category)) {
            throw new \InvalidArgumentException('category must be of type string');
        }
        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'list', array('category' => $category));
        if (count($result) != 1) {
            return false;
        }

        return $result[0]['category'] == $category;
    }


} 