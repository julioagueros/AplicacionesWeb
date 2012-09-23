<?php
class EmailConfig {

	public $default = array(
		'transport' => 'Mail',
		'from' => 'aplicacionesweb@yahoo.com',
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	//*********NOMBRES EXTRANOS************
	public $yahoo = array(
    		'host' => 'ssl://smtp.mail.yahoo.com',
    		'port' => 465,
    		'timeout' => 30,
    		'username' => 'aplicacionesweb@yahoo.com',
    		'password' => '12345678',
    		'transport' => 'Smtp'
	);

}

