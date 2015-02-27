<?php

require_once __DIR__ . '/vendor/autoload.php';

use DjDCH\Mail;

// Display and report all errors
ini_set('display_errors', 1);
error_reporting(-1);

// Set internal encoding to UTF-8
mb_internal_encoding('UTF-8');

// Create mail
$mail = new Mail();

// Message vars
$mail->from = array('john@doe.com' => 'John Doe');
$mail->to = array('receiver@domain.org' => 'A name');
$mail->subject = 'Your subject';
$mail->body = '<q>Here is the message itself</q>';

// Transport vars
$mail->host = 'smtp.example.org';
$mail->port = 465;
$mail->encryption = 'ssl';
$mail->username = 'username';
$mail->password = 'password';

// Send mail
$mail->send();
