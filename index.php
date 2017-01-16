<?php

// define error log
require 'config.php';

require 'libs/Telegram-PHP/src/Autoloader.php';
require 'core/Core.php';
require 'core/Module.php';

if($config['telegram']['id'] == 0){
	die("Please edit config.php before running.");
}

$bot = new Telegram\Bot($config['telegram']);
$tg = new Telegram\Receiver($bot);

$core = new TelegramApp\Core();
$core->setTelegram($tg);

if($config['mysql']['enable']){
	require 'libs/PHP-MySQLi-Database-Class/MysqliDb.php';
	require 'libs/PHP-MySQLi-Database-Class/dbObject.php';

	$mysql = new MysqliDb($config['mysql']);
	$core->setDB($mysql);
}

$core->load('Main');
Main::run();

?>
