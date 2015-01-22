<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


class RecipientsTest extends SubApiTestBase {

    public function testAssignListToMarketingEmail() {

        $testDataCallback = function ($data) {

            $this->assertArrayHasKey('list', $data);
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('listidentifier', $data['list']);
            $this->assertEquals('emailIdentifier', $data['name']);

            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/recipients/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->recipients->add('listidentifier', 'emailIdentifier');
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->recipients->add(null, 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->recipients->add('', 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->recipients->add('', null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testGetAllListsAssignedToMarketingEmail() {
        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);
            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/recipients/get', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array(
                array('list' => 'list1'),
                array('list' => 'list2')
            ));
        $result = $this->createApiClient($mockClient)->recipients->getAllListsAssignedToMarketingEmail('emailIdentifier');


        $this->assertEquals(array('list1', 'list2'), $result);

        try {
            $this->createApiClient($mockClient)->recipients->getAllListsAssignedToMarketingEmail('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->recipients->getAllListsAssignedToMarketingEmail(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testDeleteListFromMarketingEmail() {

        $testDataCallback = function ($data) {

            $this->assertArrayHasKey('list', $data);
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('listidentifier', $data['list']);
            $this->assertEquals('emailIdentifier', $data['name']);

            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/recipients/delete', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->recipients->deleteListFromMarketingEmail('listidentifier', 'emailIdentifier');
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->recipients->deleteListFromMarketingEmail(null, 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->recipients->deleteListFromMarketingEmail('', 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->recipients->deleteListFromMarketingEmail('', null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }
}