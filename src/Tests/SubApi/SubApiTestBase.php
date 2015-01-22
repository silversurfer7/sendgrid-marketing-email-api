<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use Silversurfer7\Sendgrid\Api\MarketingEmail\SendgridMarketingEmailApi;

abstract class SubApiTestBase extends PHPUnit_Framework_TestCase {
    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createApiMockClient() {

        $mockClient = $this->getMockBuilder('\Silversurfer7\Sendgrid\Api\Client\SendgridApiClient')
            ->setMethods(array('run'))
            ->setConstructorArgs(array('login' => 'login', 'password' => 'password'))
            ->getMock();
        return $mockClient;
    }

    /**
     * @param callable $urlCallback
     * @param callable $dataCallback
     * @param $returnValue
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createApiMockClientCallable(callable $urlCallback, callable $dataCallback, $returnValue) {
        $mockClient = $this->createApiMockClient();

        $mockClient->expects($this->any())
            ->method('run')
            ->with($this->callback($urlCallback), $this->callback($dataCallback))
            ->willReturn($returnValue)
        ;

        return $mockClient;
    }

    /**
     * @param $mockClient
     * @return SendgridMarketingEmailApi
     */
    protected function createApiClient($mockClient)
    {

        return new SendgridMarketingEmailApi($mockClient);
    }

} 