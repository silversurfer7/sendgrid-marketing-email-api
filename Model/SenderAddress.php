<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Model;


class SenderAddress {

    public $name;
    public $email;
    public $replyTo;
    public $street;
    public $city;
    public $state;
    public $zip;
    public $country;

    /**
     * return true, if the data is valid
     *
     * @return array|true
     */
    public function isValid() {

        $invalidFields = array();

        if (!is_string($this->name) || empty($this->name)) {
            $invalidFields[] = 'name';
        }

        if (!is_string($this->email) || empty($this->email)) {
            $invalidFields[] = 'email';
        }
        else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $invalidFields[] = 'email';
        }

        if (is_string($this->replyTo) && !empty($this->replyTo) && !filter_var($this->replyTo, FILTER_VALIDATE_EMAIL)) {
            $invalidFields[] = 'email';
        }

        if (!is_string($this->street) || empty($this->street)) {
            $invalidFields[] = 'street';
        }

        if (!is_string($this->city) || empty($this->city)) {
            $invalidFields[] = 'city';
        }

        if (!is_string($this->state) || empty($this->state)) {
            $invalidFields[] = 'state';
        }

        if (!is_numeric($this->zip) && !is_string($this->zip) || empty($this->zip)) {
            $invalidFields[] = 'zip';
        }

        if (!is_string($this->country) || empty($this->country)) {
            $invalidFields[] = 'country';
        }

        if (empty($invalidFields)) {
            return true;
        }
        return $invalidFields;

    }


} 