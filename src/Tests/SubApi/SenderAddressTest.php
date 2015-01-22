<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


use Silversurfer7\Sendgrid\Api\MarketingEmail\Model\SenderIdentity;

class SenderAddressTest extends SubApiTestBase {

    public function testCreateSenderAddress() {

        $senderIdentity = new SenderIdentity();
        $senderIdentity->city = 'Köln';
        $senderIdentity->country = 'DE';
        $senderIdentity->email = 'sschulze@silversurfer7.de';
        $senderIdentity->name = 'Stephan Schulze';
        $senderIdentity->state = 'Nordhrein Westfalen';
        $senderIdentity->address = 'Gottfried-Hagen-Str. 24';
        $senderIdentity->zip = 10115;

        $testDataCallback= function ($data) use ($senderIdentity) {

            $this->assertArrayHasKey('name', $data);
            $this->assertArrayHasKey('city', $data);
            $this->assertArrayHasKey('country', $data);
            $this->assertArrayHasKey('email', $data);
            $this->assertArrayHasKey('state', $data);
            $this->assertArrayHasKey('zip', $data);
            $this->assertArrayHasKey('address', $data);
            $this->assertArrayNotHasKey('replyto', $data);

            $this->assertArrayHasKey('identity', $data);


            $this->assertEquals($senderIdentity->name, $data['name']);
            $this->assertEquals($senderIdentity->city, $data['city']);
            $this->assertEquals($senderIdentity->country, $data['country']);
            $this->assertEquals($senderIdentity->email, $data['email']);
            $this->assertEquals($senderIdentity->state, $data['state']);
            $this->assertEquals($senderIdentity->city, $data['city']);
            $this->assertEquals($senderIdentity->address, $data['address']);

            $this->assertEquals('testidentity', $data['identity']);
            
            return true;
        };

        $testUrlCallback= function ($url) use ($senderIdentity) {
            $this->assertEquals('newsletter/identity/add', $url);
            return true;
        };


        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->senderAddress->add('testidentity', $senderIdentity);
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->senderAddress->add('', $senderIdentity);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->senderAddress->add(null, $senderIdentity);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testEditSenderAddress() {

        $senderIdentity = new SenderIdentity();
        $senderIdentity->city = 'Köln';
        $senderIdentity->country = 'DE';
        $senderIdentity->email = 'sschulze@silversurfer7.de';
        $senderIdentity->name = 'Stephan Schulze';
        $senderIdentity->state = 'Nordhrein Westfalen';
        $senderIdentity->address = 'Gottfried-Hagen-Str. 24';
        $senderIdentity->zip = 10115;

        $testDataCallback= function ($data) use ($senderIdentity) {

            $this->assertArrayHasKey('name', $data);
            $this->assertArrayHasKey('city', $data);
            $this->assertArrayHasKey('country', $data);
            $this->assertArrayHasKey('email', $data);
            $this->assertArrayHasKey('state', $data);
            $this->assertArrayHasKey('zip', $data);
            $this->assertArrayHasKey('address', $data);
            $this->assertArrayNotHasKey('replyto', $data);


            $this->assertArrayHasKey('identity', $data);
            $this->assertArrayHasKey('newidentity', $data);

            $this->assertEquals($senderIdentity->name, $data['name']);
            $this->assertEquals($senderIdentity->city, $data['city']);
            $this->assertEquals($senderIdentity->country, $data['country']);
            $this->assertEquals($senderIdentity->email, $data['email']);
            $this->assertEquals($senderIdentity->state, $data['state']);
            $this->assertEquals($senderIdentity->city, $data['city']);
            $this->assertEquals($senderIdentity->address, $data['address']);


            $this->assertEquals('testidentity', $data['identity']);
            $this->assertEquals('new-testidentity', $data['newidentity']);
            return true;
        };

        $testUrlCallback= function ($url) use ($senderIdentity) {
            $this->assertEquals('newsletter/identity/edit', $url);
            return true;
        };


        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->senderAddress->edit('testidentity', 'new-testidentity', $senderIdentity);
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->senderAddress->edit('', 'new-testidentity', $senderIdentity);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->senderAddress->edit(null, 'new-testidentity', $senderIdentity);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testCreateInvalidSenderAddress() {

        $senderIdentity = new SenderIdentity();
        $senderIdentity->city = 'Köln';
        $senderIdentity->country = 'DE';
        $senderIdentity->email = 'sschulze@silversurfer7.de';
        $senderIdentity->name = 'Stephan Schulze';
        $senderIdentity->state = 'Nordhrein Westfalen';
        $senderIdentity->address = 'Gottfried-Hagen-Str. 24';

        $this->setExpectedException('\InvalidArgumentException');

        $mockClient = $this->createApiMockClient();

        $this->createApiClient($mockClient)->senderAddress->add('testidentity', $senderIdentity);
    }

    public function testGetExistingSenderAddress() {

        $testDataCallback= function ($data) {

            $this->assertArrayHasKey('identity', $data);
            $this->assertEquals('testidentity', $data['identity']);

            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/identity/get', $url);
            return true;
        };

        $responseData = array(
            'city' => 'Köln',
            'name' => 'Stephan Schulze',
            'zip' => '10115',
            'replyto' => 'sschulze@silversurfer7.de',
            'country' => 'DE',
            'state' => 'Nordrhein Westfalen',
            'address' => 'Gottfried-Hagen-Str. 24',
            'email' => 'sschulze@silversurfer.de',
        );

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, $responseData);
        $response = $this->createApiClient($mockClient)->senderAddress->get('testidentity');

        $this->assertEquals($responseData['name'], $response->name);
        $this->assertEquals($responseData['city'], $response->city);
        $this->assertEquals($responseData['country'], $response->country);
        $this->assertEquals($responseData['state'], $response->state);
        $this->assertEquals($responseData['zip'], $response->zip);
        $this->assertEquals($responseData['address'], $response->address);

        $this->assertEquals($responseData['email'], $response->email);
        $this->assertEquals($responseData['replyto'], $response->replyTo);

        try {
            $this->createApiClient($mockClient)->senderAddress->get('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->senderAddress->get(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }
}