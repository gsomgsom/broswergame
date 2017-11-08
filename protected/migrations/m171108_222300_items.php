<?php

class m171108_222300_items extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("ALTER TABLE `{{items}}`
			CHANGE COLUMN `default_quality` `quality` INT(11) UNSIGNED NOT NULL DEFAULT '5' AFTER `nosell`,
			ADD COLUMN `type` VARCHAR(128) NULL DEFAULT 'collect' AFTER `bag`,
			ADD COLUMN `price_sell_coins` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `quality`,
			ADD COLUMN `price_sell_nuts` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `price_sell_coins`,
			ADD COLUMN `price_sell_mushrooms` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `price_sell_nuts`;
		");
		$this->execute("INSERT INTO `{{items}}` (`name`, `php_class`, `img`, `description`, `use_text`, `bag`, `type`, `class`, `required_lvl`, `use_stack`, `bag_limit`, `nosell`, `quality`, `price_sell_coins`, `price_sell_nuts`, `price_sell_mushrooms`) VALUES ('Желудивое ожерелье', 'ItemNecklaceAcorn', 'necklace_acorn', 'Наделяет носящего эффектом дубомыслия. Думает только о желудях и постоянно натыкается на дубы.<hr>Сокращает вдвое время поисков желудей.', 'надеть', 'equip', 'necklace', 'border-primary', 3, 0, 0, 1, 0, 5, 5, 5);");

	}

	public function safeDown()
	{
		$this->execute("ALTER TABLE `{{items}}`
			CHANGE COLUMN `quality` `default_quality` INT(11) UNSIGNED NOT NULL DEFAULT '5' AFTER `nosell``;
		");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `type`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `price_sell_coins`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `price_sell_nuts`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `price_sell_mushrooms`;");
	}

}