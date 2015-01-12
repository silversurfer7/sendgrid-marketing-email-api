<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail;


use Silversurfer7\Sendgrid\Api\Client\SendgridApiClient;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi\Categories;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi\Emails;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi\Lists;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi\MarketingEmails;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi\Recipients;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi\Schedule;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SubApi\SenderAddress;

class MarketingEmailApi {

    /** @var Categories  */
    public $categories;
    /** @var Emails  */
    public $emails;
    /** @var Lists  */
    public $lists;
    /** @var MarketingEmails  */
    public $marketingEmails;
    /** @var Recipients  */
    public $recipients;
    /** @var Schedule  */
    public $schedule;
    /** @var SenderAddress  */
    public $senderAddress;

    public function __construct(SendgridApiClient $apiClient) {
        $this->categories = new Categories($apiClient);
        $this->emails = new Emails($apiClient);
        $this->lists = new Lists($apiClient);
        $this->marketingEmails = new MarketingEmails($apiClient);
        $this->recipients = new Recipients($apiClient);
        $this->schedule = new Schedule($apiClient);
        $this->senderAddress = new SenderAddress($apiClient);
    }
}