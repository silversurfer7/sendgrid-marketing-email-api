<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\SubApi;


class MarketingEmailsTest extends SubApiTestBase {

    public function testAddMarketingEmail() {

        $testSubject = 'This is a subject';
        $testTextPart = 'this is the text part';
        $testHtmlPart = 'this is the html part';

        $testDataCallback = function ($data) use ($testSubject, $testTextPart, $testHtmlPart) {
            $this->assertArrayHasKey('identity', $data);
            $this->assertArrayHasKey('name', $data);
            $this->assertArrayHasKey('subject', $data);
            $this->assertArrayHasKey('text', $data);
            $this->assertArrayHasKey('html', $data);

            $this->assertEquals('senderIdentity', $data['identity']);
            $this->assertEquals('emailIdentifier', $data['name']);
            $this->assertEquals($testSubject, $data['subject']);
            $this->assertEquals($testTextPart, $data['text']);
            $this->assertEquals($testHtmlPart, $data['html']);

            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/add', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', 'emailIdentifier', $testSubject, $testTextPart, $testHtmlPart);
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('', 'emailIdentifier', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add(null, 'emailIdentifier', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', '', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', null, $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', 'emailIdentifier', '', $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', 'emailIdentifier', null, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', 'emailIdentifier', $testSubject, '', $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', 'emailIdentifier', $testSubject, null, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', 'emailIdentifier', $testSubject, $testTextPart, '');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->add('senderIdentity', 'emailIdentifier', $testSubject, $testTextPart, null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testEditMarketingEmail() {

        $testSubject = 'This is a subject';
        $testTextPart = 'this is the text part';
        $testHtmlPart = 'this is the html part';

        $testDataCallback = function ($data) use ($testSubject, $testTextPart, $testHtmlPart) {
            $this->assertArrayHasKey('identity', $data);
            $this->assertArrayHasKey('name', $data);
            $this->assertArrayHasKey('newname', $data);
            $this->assertArrayHasKey('subject', $data);
            $this->assertArrayHasKey('text', $data);
            $this->assertArrayHasKey('html', $data);

            $this->assertEquals('senderIdentity', $data['identity']);
            $this->assertEquals('emailIdentifier', $data['name']);
            $this->assertEquals('emailIdentifierNew', $data['newname']);
            $this->assertEquals($testSubject, $data['subject']);
            $this->assertEquals($testTextPart, $data['text']);
            $this->assertEquals($testHtmlPart, $data['html']);

            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/edit', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', 'emailIdentifierNew', $testSubject, $testTextPart, $testHtmlPart);
        $this->assertTrue($result);

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('', 'emailIdentifier', 'emailIdentifierNew', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit(null, 'emailIdentifier', 'emailIdentifierNew', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', '', 'emailIdentifierNew', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', null, 'emailIdentifierNew', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', '', $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', null, $testSubject, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', 'emailIdentifierNew', '', $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', 'emailIdentifierNew', null, $testTextPart, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', 'emailIdentifierNew', $testSubject, '', $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', 'emailIdentifierNew', $testSubject, null, $testHtmlPart);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', 'emailIdentifierNew', $testSubject, $testTextPart, '');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->edit('senderIdentity', 'emailIdentifier', 'emailIdentifierNew', $testSubject, $testTextPart, null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }


    public function testGetMarketingEmail() {


        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/get', $url);
            return true;
        };

        $testResult = array(
            "can_edit" =>  true,
            "name" =>  "SendGrid NL Test",
            "text" =>  null,
            "newsletter_id" =>  38074,
            "total_recipients" =>  1,
            "html" =>  null,
            "type" =>  "html",
            "date_schedule" =>  null,
            "identity" =>  "d22de3a53fac1abef944c80c19032c2c",
            "subject" =>  null,
        );

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, $testResult);
        $result = $this->createApiClient($mockClient)->marketingEmails->get('emailIdentifier');

        $this->assertEquals($result, $testResult);


        try {
            $this->createApiClient($mockClient)->marketingEmails->get('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->get(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}
    }

    public function testGetAllMarketingEmails() {


        $testDataCallback = function ($data) {
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/list', $url);
            return true;
        };

        $testResult = array(
            array(
                'name' => 'testname 1',
                'newsletter_id' => 1,
            ),
            array(
                'name' => 'testname 2',
                'newsletter_id' => 2,
            ),
            array(
                'name' => 'testname 3',
                'newsletter_id' => 3,
            ),
            array(
                'name' => 'testname 4',
                'newsletter_id' => 4,
            ),
        );

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, $testResult);
        $result = $this->createApiClient($mockClient)->marketingEmails->getAll();

        $this->assertEquals($result, $testResult);
    }

    public function testExistsMarketingEmails() {


        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('testname 1', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/list', $url);
            return true;
        };

        $testResult = array(
            array(
                'name' => 'testname 1',
                'newsletter_id' => 1,
            ),
            array(
                'name' => 'testname 2',
                'newsletter_id' => 2,
            ),
            array(
                'name' => 'testname 3',
                'newsletter_id' => 3,
            ),
            array(
                'name' => 'testname 4',
                'newsletter_id' => 4,
            ),
        );

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, $testResult);
        $result = $this->createApiClient($mockClient)->marketingEmails->exists('testname 1');
        $this->assertTrue($result);

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, function() {return true;}, $testResult);
        $result = $this->createApiClient($mockClient)->marketingEmails->exists('not existing');
        $this->assertFalse($result);


        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array());
        $result = $this->createApiClient($mockClient)->marketingEmails->exists('testname 1');
        $this->assertFalse($result);

    }

    public function testDeleteMarketingEmails() {


        $testDataCallback = function ($data) {
            $this->assertArrayHasKey('name', $data);

            $this->assertEquals('emailIdentifier', $data['name']);
            return true;
        };

        $testUrlCallback= function ($url) {
            $this->assertEquals('newsletter/delete', $url);
            return true;
        };

        $mockClient = $this->createApiMockClientCallable($testUrlCallback, $testDataCallback, array('message' => 'success'));
        $result = $this->createApiClient($mockClient)->marketingEmails->delete('emailIdentifier');
        $this->assertTrue($result);


        try {
            $this->createApiClient($mockClient)->marketingEmails->delete('');
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $this->createApiClient($mockClient)->marketingEmails->delete(null);
            $this->fail();
        }
        catch (\InvalidArgumentException $e) {}

    }

}