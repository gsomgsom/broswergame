<?php
if (file_exists(dirname(__FILE__).'/custom_db.php')) {
	require(dirname(__FILE__).'/custom_db.php');
}
else {
	require(dirname(__FILE__).'/db.php');
}

return [
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Лесные жители',
	'timeZone' => 'Asia/Yekaterinburg',
	'language' => 'ru',
	'preload' => ['log'],
	'import' => [
		'application.models.*',
		'application.models.forms.*',
		'application.controllers.*',
		'application.components.*',
		'application.extensions.*',
		'application.widgets.*',
		'application.helpers.*',
	],
	'params' => [
		'title' => 'Лесные жители',
		'pageTitle' => null,
		'translatedLanguages' => [
			'ru' => 'RU',
		],
		'defaultLanguage' => 'ru',
		'adminEmail' => 'zhelneen@yandex.ru',
	],
	'defaultController' => 'site',
	'modules' => [
		'auth', 'cron', 'home', 'location', 'news', 'mail',
	],
	'components' => [
		'assetManager' => array(
			'basePath' => realpath(dirname(__FILE__).'/../../assets/assets'),
			'baseUrl' => 'http://'.$_SERVER['HTTP_HOST'].'/assets/assets',
		),
		'user' => [
			'allowAutoLogin' => true,
			'class' => 'WebUser',
		],
		'db' => setDbOptions(),
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'authManager' => [
			'class' => 'PhpAuthManager',
			'defaultRoles' => ['guest'],
		],
		'urlManager' => [
			'showScriptName' => false,
			'urlFormat' => 'path',
			'rules' => [
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			],
		],
	],
];
