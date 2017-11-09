<?php

class m171109_235959_items extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("INSERT INTO `{{items}}` (`name`, `php_class`, `img`, `description`, `use_text`, `class`, `stack`, `bag_limit`, `nosell`, `quality`, `price_sell_coins`, `price_sell_nuts`, `price_sell_mushrooms`) VALUES ('Эликсир зоркости', 'ItemElixrSharpeye', 'potion_big_violett', 'Выпивший на час становится более зорким, благодаря чему время поисков желудей соращается вдвое.', 'выпить', 'border-primary', 5, 1000, 1, 1, 5, 5, 5);");
	}

	public function safeDown()
	{
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=13;");
	}

}