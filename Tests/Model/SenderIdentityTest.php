<?php
/**
 *
 * @author: sschulze@silversurfer7.de
 */

namespace Silversurfer7\Sendgrid\Api\MarketingEmail\Tests\Model;


use PHPUnit_Framework_TestCase;
use Silversurfer7\Sendgrid\Api\MarketingEmail\Model\SenderIdentity;

class SenderIdentityTest extends PHPUnit_Framework_TestCase {


    public function testValidBaseCheck() {
        $senderIdentity = $this->createValidSenderIdentity();

        $result = $senderIdentity->isValid();
        $this->assertTrue($result);

        $toUpdate = array(
            'name' => '',
            'address' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'country' => '',
        );

        foreach ($toUpdate as $key => $value) {
            $senderIdentity->$key = $value;
        }

        $result = $senderIdentity->isValid();
        foreach ($toUpdate as $key => $value) {
            $this->assertContains($key, $result);
        }

        $senderIdentity = $this->createValidSenderIdentity();
        $senderIdentity->country = "Germany";
        $result = $senderIdentity->isValid();
        $this->assertContains('country', $result);

    }

    public function testEmailAddressValidation() {

        $senderIdentity = $this->createValidSenderIdentity();

        $senderIdentity->email = 'invalid email';
        $result = $senderIdentity->isValid();
        $this->assertNotEmpty($result);
        $this->assertContains('email', $result);

        $senderIdentity = $this->createValidSenderIdentity();
        $senderIdentity->email = null;
        $result = $senderIdentity->isValid();
        $this->assertNotEmpty($result);
        $this->assertContains('email', $result);


        $senderIdentity = $this->createValidSenderIdentity();
        $senderIdentity->replyTo = 'invalid email';
        $result = $senderIdentity->isValid();
        $this->assertNotEmpty($result);
        $this->assertContains('replyTo', $result);

        $senderIdentity = $this->createValidSenderIdentity();
        $senderIdentity->replyTo = null;
        $result = $senderIdentity->isValid();
        $this->assertTrue($result);

    }


    public function testZipValidation() {
        $senderIdentity = $this->createValidSenderIdentity();
        $senderIdentity->zip = array('test');
        $result = $senderIdentity->isValid();
        $this->assertNotEmpty($result);
        $this->assertContains('zip', $result);

        $senderIdentity->zip = null;
        $result = $senderIdentity->isValid();
        $this->assertNotEmpty($result);
        $this->assertContains('zip', $result);

        $senderIdentity->zip = 'A-12345';
        $result = $senderIdentity->isValid();
        $this->assertTrue($result);

    }

    protected function createValidSenderIdentity() {
        $senderIdentity = new SenderIdentity();
        $senderIdentity->city = 'City';
        $senderIdentity->country = 'DE';
        $senderIdentity->email = 'test@test.com';
        $senderIdentity->name = 'Firstname Lastname';
        $senderIdentity->replyTo = 'replyto@test.com';
        $senderIdentity->state = 'State';
        $senderIdentity->address = 'Street 12';
        $senderIdentity->zip = 12345;
        return $senderIdentity;
    }



} 