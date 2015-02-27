<?php

namespace DjDCH\tests;

class MailTest extends \PHPUnit_Framework_TestCase {

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
        $mail->from = array('john@doe.com' => 'John Doe');
        $mail->to = array('receiver@domain.org' => 'A name');
        $mail->subject = 'Your subject';
        $mail->body = '<p>Here is the message itself</p>';

        // Transport vars
        $mail->host = 'localhost';
        $mail->port = 4456;
        $mail->encryption = '';
        $mail->username = '';
        $mail->password = '';

        // Send mail
        $mail->send();
    }
}
