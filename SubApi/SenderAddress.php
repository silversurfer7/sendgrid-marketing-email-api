<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


class SenderAddress extends BaseElement
{
    const ACTION_BASE_URL = 'newsletter/identity/';

    public function add(
        $senderIdentity,
        $name,
        $senderEmail,
        $street,
        $city,
        $state,
        $zip,
        $country,
        $replyToEmail = ''
    ) {
        $arguments = array(
            'senderIdentity' => 'identity',
            'senderEmail' => 'email',
            'name' => 'name',
            'street' => 'street',
            'city' => 'city',
            'state' => 'state',
            'zip' => 'zip',
            'country' => 'country',
            'replyToEmail' => 'replyto'
        );

        $data = array();

        foreach ($arguments as $varName => $sendgridName) {
            if (!is_string($$varName)) {
                throw new \InvalidArgumentException($varName . ' must be of type string');
            }
            if (strlen($$varName)) {
                $data[$sendgridName] = $$varName;
            }
        }

        $this->apiClient->run(
            self::ACTION_BASE_URL . 'add',
            $data
        );

        return true;
    }

    public function edit(
        $senderIdentity,
        $senderEmail,
        $newSenderIdentity = '',
        $name = '',
        $street = '',
        $city = '',
        $state = '',
        $zip = '',
        $country = '',
        $replyToEmail = ''
    ) {

        $arguments = array(
            'senderIdentity' => 'identity',
            'senderEmail' => 'email',
            'newSenderIdentity' => 'newidentity',
            'name' => 'name',
            'street' => 'street',
            'city' => 'city',
            'state' => 'state',
            'zip' => 'zip',
            'country' => 'country',
            'replyToEmail' => 'replyto'
        );

        $data = array();

        foreach ($arguments as $varName => $sendgridName) {
            if (!is_string($$varName)) {
                throw new \InvalidArgumentException($varName . ' must be of type string');
            }
            if (strlen($$varName)) {
                $data[$sendgridName] = $$varName;
            }
        }

        $this->apiClient->run(
            self::ACTION_BASE_URL . 'edit',
            $data
        );

        return true;
    }

    public function get($senderIdentity)
    {
        if (!is_string($senderIdentity)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        return $this->apiClient->run(
            self::ACTION_BASE_URL . 'get',
            array('identity' => $senderIdentity)
        );
    }


    public function getAll()
    {
        return $this->apiClient->run(self::ACTION_BASE_URL . 'list', array());
    }

    public function exists($senderIdentity)
    {
        if (!is_string($senderIdentity)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        return count($this->apiClient->run(self::ACTION_BASE_URL . 'list', array('identity' => $senderIdentity))) == 1;
    }


    public function delete($senderIdentity)
    {
        if (!is_string($senderIdentity)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        return $this->apiClient->run(
            self::ACTION_BASE_URL . 'delete',
            array('identity' => $senderIdentity)
        );
    }
} 