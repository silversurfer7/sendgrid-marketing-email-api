<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Model;


class EmailRecipient {

    private $email;
    private $name;
    private $placeholder = array();

    public function __construct($email, $name) {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('email address is not valid');
        }

        if (empty($name) || strlen($name) == 0) {
            throw new \InvalidArgumentException('name is not valid');
        }

        $this->email = $email;
        $this->name = $name;
    }

    public function addPlaceholder($placeholder, $value) {
        $this->placeholder[$placeholder] = $value;
    }

    public function getApiData() {
        $return = array(
            'name' => $this->name,
            'email' => $this->email,
        );

        return array_merge($this->placeholder, $return);
    }

} 