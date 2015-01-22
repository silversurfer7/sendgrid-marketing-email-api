<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


class ScheduleTest extends SubApiTestBase {

    public function testSendMarketingEmailNow() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);
            $this->assertArrayNotHasKey('at', $data);
            $this->assertArrayNotHasKey('after', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/schedule/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->schedule->sendMarketingEmailNow('emailIdentifier');
        $this->assertTrue($result);


        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailNow('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailNow(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testSendMarketingEmailInMinutes() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);
            $this->assertArrayHasKey('after', $data);

            $this->assertArrayNotHasKey('at', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            $this->assertEquals('10', $data['after']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/schedule/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->schedule->sendMarketingEmailInMinutes('emailIdentifier', 10);
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailInMinutes('', 10);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailInMinutes(null, 10);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}


        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailInMinutes('emailIdentifier', 'abc');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailInMinutes('emailIdentifier', 0);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailInMinutes('emailIdentifier', -10);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }


    public function testSendMarketingEmailAt() {

        $testDate = new \DateTime('+1 day');

        $testDataCallback = function ($data) use ($testDate) {
            $this->assertArrayHasKey('name', $data);
            $this->assertArrayHasKey('at', $data);

            $this->assertArrayNotHasKey('after', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            $this->assertEquals($testDate->format('c'), $data['at']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/schedule/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->schedule->sendMarketingEmailAt('emailIdentifier', $testDate);
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailAt('', $testDate);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailAt(null, $testDate);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}


        $testDate->modify('-1day');
        try {
            $this->createApiClient($mockClient)->schedule->sendMarketingEmailAt('emailIdentifier', $testDate);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testGetMarketingEmailDeliveryTime() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/schedule/get', $url);
            return true;
        };

        $testDate = new \DateTime('2012-09-05 21:22:02');

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('date' => $testDate->format('Y-m-d H:i:s')));
        $result = $this->createApiClient($mockClient)->schedule->get('emailIdentifier');

        $this->assertEquals($result->getTimestamp(), $testDate->getTimestamp());

        try {
            $this->createApiClient($mockClient)->schedule->get('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->schedule->get(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testDeleteMarketingEmailSchedule() {
        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/schedule/delete', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->schedule->delete('emailIdentifier');
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->schedule->delete('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->schedule->delete(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }
}