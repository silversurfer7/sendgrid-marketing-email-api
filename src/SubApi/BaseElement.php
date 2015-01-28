<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


use Silversurfer7\Sendgrid\Api\Client\SendgridApiClient;

abstract class BaseElement {
    protected $apiClient;

    protected $lastActionError = '';

    public function __construct(SendgridApiClient $apiClient) {
        $this->apiClient = $apiClient;
    }

    protected function wasActionSuccessful($response) {
        $this->lastActionError = '';


        if (isset($response['error'])) {
            $this->lastActionError = $response['error'];
            return false;
        }

        if ($response['message'] !== 'success') {
            $this->lastActionError = $response['message'];
            return false;
        }

        return true;
    }

    public function getLastActionError() {
        return $this->lastActionError;
    }
} 