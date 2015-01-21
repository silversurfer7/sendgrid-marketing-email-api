<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


use PHPUnit_Framework_TestCase;
use Silversurfer7\Sendgrid\Api\MarketingEmail\MarketingEmailApi;

abstract class SubApiTestBase extends PHPUnit_Framework_TestCase {
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function createApiMockClient() {
        $mockClient = $this->getMockBuilder('\Silversurfer7\Sendgrid\Api\Client\SendgridApiClient')
            ->setMethods(array('run'))
            ->setConstructorArgs(array('login' => 'login', 'password' => 'password'))
            ->getMock();

        return $mockClient;
    }

    /**
     * @param $mockClient
     * @return MarketingEmailApi
     */
    protected function createApiClient($mockClient)
    {

        return new MarketingEmailApi($mockClient);
    }

} 