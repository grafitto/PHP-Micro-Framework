<?php
class Email{
	private $message;
	private $transporter;
	private $mailer;
	private $subject;
	private $recipients = [];
	private $sender;
	
	
	public function __construct(){
		$this->message = Swift_Message::newInstance();
		$this->transporter = Swift_SmtpTransport::newInstance(EMAIL_HOST,EMAIL_PORT);
	}
	public function __get($name){
		return $this->$name;
	}
	public function __set($name, $value){
		$this->$name = $value;
	}
	public function addHTMLBody($content){
		$this->message->setBody($content, "text/html");
	}
	public function appendHTMLBody($content0){
		$this->message->addPart($content, "text/html");
	}
	public function attach($path,$filename){
		$this->message->attach(Swift_Attachment::fromPath($path)->setFilename($filename));
	}
	public function send(){
		$this->message->setFrom($this->sender);
		$this->message->setTo($this->recipients);
		$this->message->setSubject($this->subject);
		
		$this->transporter->setUsername(EMAIL_USERNAME);
		$this->transporter->setPassword(EMAIL_PASSWORD);
		
		$this->mailer = Swift_Mailer::newInstance($this->transporter);
		
		return $this->mailer->send($this->message);
	}
	
}