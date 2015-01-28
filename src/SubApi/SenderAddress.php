<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


use Silversurfer7\Sendgrid\Api\MarketingEmail\Exception\ElementNotFoundException;
use Silversurfer7\Sendgrid\Api\MarketingEmail\Model\SenderIdentity;

class SenderAddress extends BaseElement
{
    const ACTION_BASE_URL = 'newsletter/identity/';

    public function add(
        $senderIdentifier,
        SenderIdentity $senderIdentity
    ) {

        if (!is_string($senderIdentifier) || empty($senderIdentifier)) {
            throw new \InvalidArgumentException('senderIdentity must be of type string and not empty');
        }

        if (($validationResult = $senderIdentity->isValid()) !== true) {
            var_dump($senderIdentity);
            throw new \InvalidArgumentException('sender identity is not valid; Fields with errors: ' . implode(', ', $validationResult));
        }

        $data = array(
            'identity' => $senderIdentifier,
            'email' => $senderIdentity->email,
            'name' => $senderIdentity->name,
            'address' => $senderIdentity->address,
            'zip' => $senderIdentity->zip,
            'city' => $senderIdentity->city,
            'state' => $senderIdentity->state,
            'country' => $senderIdentity->country
        );

        if ($senderIdentity->replyTo) {
            $data['replyto'] = $senderIdentity->replyTo;
        }
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'add',$data);

        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    public function edit(
        $senderIdentifier,
        $newSenderIdentifier,
        SenderIdentity $senderIdentity
    ) {

        if (!is_string($senderIdentifier) || empty($senderIdentifier)) {
            throw new \InvalidArgumentException('senderIdentifier must be of type string and not empty');
        }

        if (!is_string($newSenderIdentifier) || empty($newSenderIdentifier)) {
            throw new \InvalidArgumentException('newSenderIdentifier must be of type string and not empty');
        }

        if ($senderIdentity->isValid() !== true) {
            throw new \InvalidArgumentException('sender identity is not valid');
        }

        $data = array(
            'identity' => $senderIdentifier,
            'newidentity' => $newSenderIdentifier,
            'email' => $senderIdentity->email,
            'name' => $senderIdentity->name,
            'address' => $senderIdentity->address,
            'zip' => $senderIdentity->zip,
            'city' => $senderIdentity->city,
            'state' => $senderIdentity->state,
            'country' => $senderIdentity->country
        );

        if ($senderIdentity->replyTo) {
            $data['replyto'] = $senderIdentity->replyTo;
        }

        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'edit',$data);

        if (!$this->wasActionSuccessful($response)) {
            return false;
        }
        return true;
    }

    public function get($senderIdentifier)
    {
        if (!is_string($senderIdentifier) || empty($senderIdentifier)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        $response  = $this->apiClient->run(
            self::ACTION_BASE_URL . 'get',
            array('identity' => $senderIdentifier)
        );

        if (empty($response)) {
            throw new ElementNotFoundException();
        }

        $senderIdentifier = new SenderIdentity();
        $senderIdentifier->loadFromApiResponse($response);

        return $senderIdentifier;
    }


    /**
     * get all stored identities
     * @return array
     */
    public function getAll()
    {
        $response = $this->apiClient->run(self::ACTION_BASE_URL . 'list', array());
        $return = array();
        foreach ($response as $one) {
            $return[] = $one['identity'];
        }
        return $return;
    }

    /**
     * @param $senderIdentifier
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function exists($senderIdentifier)
    {
        if (!is_string($senderIdentifier) || empty($senderIdentifier)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        $result = $this->apiClient->run(self::ACTION_BASE_URL . 'list', array('identity' => $senderIdentifier));

        if (count($result) == 0) {
            return false;
        }

        foreach ($result as $one) {
            if ($one['identity'] == $senderIdentifier) {
                return true;
            }
        }
        return false;

    }


    public function delete($senderIdentifier)
    {
        if (!is_string($senderIdentifier) || empty($senderIdentifier)) {
            throw new \InvalidArgumentException('sender identity must be of type string');
        }

        return $this->apiClient->run(
            self::ACTION_BASE_URL . 'delete',
            array('identity' => $senderIdentifier)
        );
    }
} 