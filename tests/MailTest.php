<?php

namespace DjDCH\tests;

class MailTest extends \PHPUnit_Framework_TestCase {

    const MAIL_FROM    = 'john@doe.com';
    const MAIL_TO      = 'receiver@domain.org';
    const MAIL_SUBJECT = 'Test subject';
    const MAIL_BODY    = '<p>Test message body.</p>';

    public function testMailing()
    {
        // Create a mock for the Mail class
        $mail = $this->getMockBuilder('DjDCH\Mail')
                     ->setMethods(array('println'))
                     ->getMock();

        // Set up the expectation for the println() method
        $mail->expects($this->once())
             ->method('println')
             ->with($this->equalTo('1 MTA accepted the message for delivery.'));

        // Message vars
        $mail->from = array(self::MAIL_FROM => 'John Doe');
        $mail->to   = array(self::MAIL_TO => 'A name');
        $mail->subject = self::MAIL_SUBJECT;
        $mail->body    = self::MAIL_BODY;

        // Transport vars
        $mail->host = 'localhost';
        $mail->port = 4456;
        $mail->encryption = '';
        $mail->username = '';
        $mail->password = '';

        // Send mail
        $result = $mail->send();

        // Ensure valid result
        $this->assertEquals(1, $result);

        // Get mail from mailcatcher
        $messages = json_decode(file_get_contents('http://127.0.0.1:1080/messages'));
        $message = json_decode(file_get_contents('http://127.0.0.1:1080/messages/' . $messages[0]->id . '.json'));

        // Ensure that received mail was as sent
        $this->assertEquals(sprintf('<%s>', self::MAIL_FROM), $message->sender);
        $this->assertEquals(sprintf('<%s>', self::MAIL_TO), $message->recipients[0]);
        $this->assertEquals(self::MAIL_SUBJECT, $message->subject);
        preg_match_all('/\r\n\r\n(.*)\r\n$/', $message->source, $matches); // Extract body from source
        $this->assertEquals(self::MAIL_BODY, $matches[1][0]);
    }
}
