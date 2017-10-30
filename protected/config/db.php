<?php
define('TEST_SERVER', true);

/**
 * Параметры подключения к БД
 */
function setDbOptions()
{
	$settings = [
		'class' => 'CDbConnection',
		'emulatePrepare' => true,
		'enableProfiling' => false,
		'enableParamLogging' => false,
		'charset' => 'utf8',
		'tablePrefix' => 'g_',
	];

	return $settings + [
		'connectionString' => 'mysql:host=localhost;dbname=game',
		'username' => 'root',
		'password' => '',
	];
}
