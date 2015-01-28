<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


class ListsTest extends SubApiTestBase {

    public function testCreateCategory() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('listIdentifier', $data['list']);
            $this->assertEquals('emailAddressColumnName', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->lists->add('listIdentifier', 'emailAddressColumnName');
        $this->assertTrue($result);

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);
            $this->assertArrayNotHasKey('name', $data);

            $this->assertEquals('listIdentifier', $data['list']);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->lists->add('listIdentifier');
        $this->assertTrue($result);


        try {
            $this->createApiClient($mockClient)->lists->add('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->add(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->add('listIdentifier', null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testRenameList() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);
            $this->assertArrayHasKey('newlist', $data);

            $this->assertEquals('listIdentifier', $data['list']);
            $this->assertEquals('newListIdentifier', $data['newlist']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/edit', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->lists->rename('listIdentifier', 'newListIdentifier');
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->lists->rename('', 'newListIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->rename(null, 'newListIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->rename('listIdentifier', '');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->rename('listIdentifier', null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testGetList() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);

            $this->assertEquals('listIdentifier', $data['list']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/get', $url);
            return true;
        };

        $testResult = array(
            "id" =>  1,
            "list" =>  "Testlist",
        );

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, $testResult);
        $result = $this->createApiClient($mockClient)->lists->get('listIdentifier');

        $this->assertEquals($result, $testResult);


        try {
            $this->createApiClient($mockClient)->lists->get('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->get(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testGetAllLists() {

        $testDataCallback = function ($data) {
            $this->assertEmpty($data);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/get', $url);
            return true;
        };

        $resultData = array(
            array(
                'id' => 1,
                'list' => 'test 1',
            ),
            array(
                'id' => 2,
                'list' => 'test 2',
            ),
            array(
                'id' => 3,
                'list' => 'test 3',
            ),
        );

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, $resultData);
        $result = $this->createApiClient($mockClient)->lists->getAll();
        $this->assertEquals($resultData, $result);
    }

    public function testExistsList() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);

            $this->assertEquals('test 1', $data['list']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/get', $url);
            return true;
        };

        $resultData = array(
            array(
                'id' => 1,
                'list' => 'test 1',
            ),
            array(
                'id' => 2,
                'list' => 'test 2',
            ),
            array(
                'id' => 3,
                'list' => 'test 3',
            ),
        );

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, $resultData);
        $result = $this->createApiClient($mockClient)->lists->exists('test 1');
        $this->assertTrue($result);

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, function () {return true;}, $resultData);
        $result = $this->createApiClient($mockClient)->lists->exists('test 500');
        $this->assertFalse($result);


        try {
            $this->createApiClient($mockClient)->lists->exists('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->exists(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testDeleteList() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);

            $this->assertEquals('listIdentifier', $data['list']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/delete', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->lists->delete('listIdentifier');
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->lists->delete('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->lists->delete(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }
}