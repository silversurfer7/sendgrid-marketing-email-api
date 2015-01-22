<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


use Silversurfer7\Sendgrid\Api\MarketingEmail\Exception\InvalidRecipientDataException;

class EmailsTest extends SubApiTestBase {

    public function testAddEmail() {

        $testEmailAdresses = array(
            array(
                'name' => 'Stephan Schulze',
                'email' => 'sschulze@silversurfer7.de',
                'additionalField1' => 'fieldValue1',
                'additionalField2' => 'fieldValue2',
                'additionalField3' => 'fieldValue3',
            )
        );

        $testDataCallback = function ($data) use ($testEmailAdresses) {
            $this->assertArrayHasKey('list', $data);
            $this->assertArrayHasKey('data', $data);

            $this->assertEquals('listIdentifier', $data['list']);

            $emailData = json_decode($data['data'], true);
            $this->assertTrue(is_array($emailData));

            $this->assertEquals($emailData, $testEmailAdresses);

            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/email/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('inserted' => count($testEmailAdresses)));
        $result = $this->createApiClient($mockClient)->emails->add('listIdentifier', $testEmailAdresses);

        $this->assertEquals($result, count($testEmailAdresses));


        try {
            $this->createApiClient($mockClient)->emails->add('', $testEmailAdresses);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->add(null, $testEmailAdresses);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

    public function testAddEmailArgumentCheck() {
        $mockClient = $this->createApiMockClient();

        $testEmailAdresses = array();

        for ($counter = 0; $counter <= 1002; ++$counter) {
            $testEmailAdresses[] =
                array(
                    'name' => 'Stephan Schulze',
                    'email' => 'sschulze@silversurfer7.de',
                    'additionalField1' => 'fieldValue1',
                    'additionalField2' => 'fieldValue2',
                    'additionalField3' => 'fieldValue3',
            );
        }
        try {
            $this->createApiClient($mockClient)->emails->add('listIdentifier', $testEmailAdresses);
            $this->fail();
        }
        catch (InvalidRecipientDataException $e) {}

        $testEmailAdresses = array(
            array(
                //'name' => 'Stephan Schulze',
                'email' => 'sschulze@silversurfer7.de',
                'additionalField1' => 'fieldValue1',
                'additionalField2' => 'fieldValue2',
                'additionalField3' => 'fieldValue3',
            )
        );
        try {
            $this->createApiClient($mockClient)->emails->add('listIdentifier', $testEmailAdresses);
            $this->fail();
        }
        catch (InvalidRecipientDataException $e) {}

        $testEmailAdresses = array(
            array(
                'name' => 'Stephan Schulze',
                //'email' => 'sschulze@silversurfer7.de',
                'additionalField1' => 'fieldValue1',
                'additionalField2' => 'fieldValue2',
                'additionalField3' => 'fieldValue3',
            )
        );
        try {
            $this->createApiClient($mockClient)->emails->add('listIdentifier', $testEmailAdresses);
            $this->fail();
        }
        catch (InvalidRecipientDataException $e) {}
    }

    public function testEmailGet() {
        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);
            $this->assertEquals('listIdentifier', $data['list']);

            $this->assertArrayNotHasKey('email', $data);
            $this->assertArrayNotHasKey('unsubscribed', $data);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/email/get', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array());
        $this->createApiClient($mockClient)->emails->get('listIdentifier');

        try {
            $this->createApiClient($mockClient)->emails->get('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->get(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testEmailGetWithAdresses() {
        $testEmailAdresses = array('sschulze@silversurfer7.de');
        $testDataCallback = function ($data) use ($testEmailAdresses) {
            $this->assertArrayHasKey('list', $data);
            $this->assertEquals('listIdentifier', $data['list']);

            $this->assertArrayHasKey('email', $data);
            $this->assertEquals($testEmailAdresses, $data['email']);


            $this->assertArrayNotHasKey('unsubscribed', $data);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/email/get', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array());
        $this->createApiClient($mockClient)->emails->get('listIdentifier', $testEmailAdresses);
    }

    public function testEmailGetUnsubscribes() {
        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);
            $this->assertEquals('listIdentifier', $data['list']);

            $this->assertArrayHasKey('unsubscribed', $data);
            $this->assertEquals(1, $data['unsubscribed']);

            $this->assertArrayNotHasKey('email', $data);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/email/get', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array());
        $this->createApiClient($mockClient)->emails->get('listIdentifier', array(), 1);

        try {
            $this->createApiClient($mockClient)->emails->get('listIdentifier', array(), 22);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->get('listIdentifier', array(), -1);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->get('listIdentifier', array(), 'abc');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->get('listIdentifier', array(), null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testEmailCount() {
        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('list', $data);
            $this->assertEquals('listIdentifier', $data['list']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/email/count', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('count' => 2));
        $result = $this->createApiClient($mockClient)->emails->count('listIdentifier');
        $this->assertEquals($result, 2);

        try {
            $this->createApiClient($mockClient)->emails->count('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->count(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testEmailDelete() {

        $testEmailAddresses = array(
            'test@example.com',
            'test2@example.com',
            'test3@example.com',
        );

        $testDataCallback = function ($data) use ($testEmailAddresses) {
            $this->assertArrayHasKey('list', $data);
            $this->assertEquals('listIdentifier', $data['list']);

            $this->assertArrayHasKey('email', $data);
            $this->assertEquals($testEmailAddresses, $data['email']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/lists/email/delete', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('removed' => count($testEmailAddresses)));
        $result = $this->createApiClient($mockClient)->emails->delete('listIdentifier', $testEmailAddresses);
        $this->assertEquals($result, count($testEmailAddresses));

        try {
            $this->createApiClient($mockClient)->emails->delete('', $testEmailAddresses);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->delete(null, $testEmailAddresses);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->emails->delete('listIdentifier', array());
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }
}