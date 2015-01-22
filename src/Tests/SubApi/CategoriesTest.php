<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


class CategoriesTest extends SubApiTestBase {

    public function testCreateCategory() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('category', $data);

            $this->assertEquals('categoryIdentifier', $data['category']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/category/create', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->categories->create('categoryIdentifier');
        $this->assertTrue($result);


        try {
            $this->createApiClient($mockClient)->categories->create('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->create(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testAddCategory() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('category', $data);
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('categoryIdentifier', $data['category']);
            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/category/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->categories->add('categoryIdentifier', 'emailIdentifier');
        $this->assertTrue($result);


        try {
            $this->createApiClient($mockClient)->categories->add('', 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->add(null, 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->add('categoryIdentifier', '');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->add('categoryIdentifier', null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testRemoveOneCategory() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('category', $data);
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('categoryIdentifier', $data['category']);
            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/category/remove', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->categories->remove('categoryIdentifier', 'emailIdentifier');
        $this->assertTrue($result);


        try {
            $this->createApiClient($mockClient)->categories->remove('', 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->remove(null, 'emailIdentifier');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->remove('categoryIdentifier', '');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->remove('categoryIdentifier', null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testRemoveAllCategories() {

        $testDataCallback = function ($data) {
            $this->assertArrayNotHasKey('category', $data);
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/category/remove', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->categories->removeAll('emailIdentifier');
        $this->assertTrue($result);


        try {
            $this->createApiClient($mockClient)->categories->removeAll('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->removeAll(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testListAllCategories() {

        $testDataCallback = function ($data) {
            $this->assertArrayNotHasKey('category', $data);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/category/list', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array(
                array('category' => 'category1'),
                array('category' => 'category2')
            ));
        $result = $this->createApiClient($mockClient)->categories->listAll();

        $this->assertEquals(array('category1', 'category2'), $result);
    }

    public function testExistCategory() {

        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('category', $data);
            $this->assertEquals('categoryIdentifier', $data['category']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/category/list', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array(
                array('category' => 'categoryIdentifier'),
            ));
        $result = $this->createApiClient($mockClient)->categories->exists('categoryIdentifier');

        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->categories->exists('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->categories->exists(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }


}