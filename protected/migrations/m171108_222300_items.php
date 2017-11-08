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
		$this->execute("update {{items}} set quality = 1;");
		$this->execute("update {{player_items}} set quality = 1;");
		$this->execute("UPDATE {{items}} SET `use_text`='надеть', `bag`='equip', `type`='helm', `class`='border-primary', `required_lvl`=3, `use_stack`=0, `quality`=4, `price_sell_coins`=5, `price_sell_nuts`=5, `price_sell_mushrooms`=5 WHERE `id` in (10, 11, 12);");
		$this->execute("update {{player_items}} set quality = 4 where item_id in (10,11,12);");
		$this->execute("UPDATE {{items}} SET `type`='cloak' WHERE `id`=11;");
		$this->execute("UPDATE {{items}} SET `type`='necklace' WHERE `id`=12;");
	}

	public function safeDown()
	{
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=12;");
		$this->execute("ALTER TABLE `{{items}}`
			CHANGE COLUMN `quality` `default_quality` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `nosell`;
		");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `type`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `price_sell_coins`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `price_sell_nuts`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `price_sell_mushrooms`;");
	}

}