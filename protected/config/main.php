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
		'application.models.forms.*',
		'application.models.items.*',
		'application.models.*',
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
		'senderEmail' => 'noreply@zhelnin.perm.ru',
		'senderUser' => 'noreply@zhelnin.perm.ru',
		'senderPass' => 'udz76zYZ',
		'constructionMode' => !TEST_SERVER, // вместо страницы авторизации выводится заглушка с формой записи на тест
	],
	'defaultController' => 'site',
	'modules' => [
		'auth', 'cron', 'player', 'location', 'news', 'mail', 'forum', 'chat', 'world',
	],
	'components' => [
		'assetManager' => [
			'basePath' => realpath(dirname(__FILE__).'/../../assets/assets'),
			'baseUrl' => 'http://'.$_SERVER['HTTP_HOST'].'/assets/assets',
		],
		'user' => [
			'allowAutoLogin' => true,
			'class' => 'WebUser',
		],
		'mailer' => [
			'class' => 'application.extensions.mailer.EMailer',
			'pathViews' => 'application.views.email',
			'pathLayouts' => 'application.views.email.layouts'
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

				'<controller(forum)>'=>'forum/<controller>',
				'<controller(forum)>/<action>/<id>'=>'forum/<controller>/<action>',
			],
		],
	],
];
