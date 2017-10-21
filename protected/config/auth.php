<?php
return [
	'guest' => [
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Guest',
		'bizRule' => null,
		'data' => null,
	],
	'user' => [
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'User',
		'children' => [
			'guest',
		],
		'bizRule' => null,
		'data' => null,
	],
	'admin' => [
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Admin',
		'children' => [
			'user',
		],
		'bizRule' => null,
		'data' => null,
	],
];
