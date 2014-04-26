<?php

class Mail {
    // Message vars
    public $from;
    public $to;
    public $subject;
    public $body;

    // Transport vars
    public $host;
    public $port;
    public $encryption;
    public $username;
    public $password;

    // Send mail
    public function send()
    {
        // Create a message
        $message = Swift_Message::newInstance()
            ->setFrom($this->from)
            ->setTo($this->$to)
            ->setSubject($this->subject)
            ->setBody($this->body, 'text/html')
            ->setMaxLineLength(128)
        ;

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance($this->host, $this->port, $this->encryption)
            ->setUsername($this->username)
            ->setPassword($this->password)
        ;

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        // Send the message
        $result = $mailer->send($message);

        // Print result
        _println($result . ' MTA accepted the message for delivery.');
    }
}
