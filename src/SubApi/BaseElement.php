<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi;


use Silversurfer7\Sendgrid\Api\Client\SendgridApiClient;

abstract class BaseElement {
    protected $apiClient;

    public function __construct(SendgridApiClient $apiClient) {
        $this->apiClient = $apiClient;
    }
} 