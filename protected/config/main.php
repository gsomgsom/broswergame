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

		// Игрок
		'player_exp_rate' => 1, // множитель опыта игрока
		'player_elixir_rate' => 1, // множитель длительности эликсиров

		// Разведка
		'location_scout_day_limit' => 120 * 60, // разведка, лимит времени в день, 120 минут
		'location_scout_time' => 10 * 60, // разведка, стандартное время, 10 минут
		'location_scout_coins_chance' => 0.67, // разведка, шанс успешной разведки, 67%
		'location_scout_coins_rate' => 1, // разведка, множитель награды в монетах
		'location_scout_chest_chance' => 0.10, // разведка, шанс найти клад, 10%

		// Поиск желудей
		'location_search_fast' => 10 * 60, // поиск желудей, быстрый, 10 минут
		'location_search_long' => 60 * 60, // поиск желудей, долгий, 60 минут

		// Колесо фортуны
		'location_wheel' => 50, // начальная стоимость кручения колеса
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
			],
		],
	],
];
