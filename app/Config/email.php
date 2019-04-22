<?php

class EmailConfig
{
	public $test_email_config = array(
		'transport'         => 'Mail',
		'from'              => array('no-reply@saulostopa.com' => '{Client}'),
		'charset'           => 'utf-8',
		'headerCharset'     => 'utf-8'
	);

/*
	public $default = array
	(
		'transport'         => 'Mail',
		'from'              => array('no-reply@construlista.com.br' => 'Construlista'),
		'charset'           => 'utf-8',
		'headerCharset'     => 'utf-8'
	);
*/

	public $default = array(
		'transport' => 'Smtp',
		'from' => array('noreply.construlista@gmail.com' => 'Construlista'),
		'host' => 'ssl://smtp.gmail.com',
		'port' => 465,
		'timeout' => 30,
		'username' => 'noreply.construlista@gmail.com',
		'password' => '123456Ab#',
		'client' => null,
		'log' => false,
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
	);

	public $smtp = array(
		'transport' => 'Smtp',
		'from' => array('site@localhost' => 'My Site'),
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => false,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $fast = array(
		'from' => 'you@localhost',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => null,
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => true,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);
}
