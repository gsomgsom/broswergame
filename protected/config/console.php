<?php
if (file_exists(dirname(__FILE__).'/custom_db.php')) {
	require(dirname(__FILE__).'/custom_db.php');
}
else {
	require(dirname(__FILE__).'/db.php');
}

return [
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Prototype console',
	'commandMap' => [
		'migrate' => [
			'class' => 'system.cli.commands.MigrateCommand',
			'migrationTable' => '{{migration}}'
		],
		'database' => [
			'class' => 'application.components.EDatabaseCommand',
		],
	],
	'components' => [
		'db' => setDbOptions(),
	],
];
