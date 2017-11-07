<?php

class m171106_232000_player_items_equipped extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("ALTER TABLE `{{player_items}}`
			ADD COLUMN `equipped` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `variant`;");

		$this->execute("ALTER TABLE `{{items}}`
			ADD COLUMN `php_class` VARCHAR(128) NULL DEFAULT NULL AFTER `name`;");

		// Устанавливаем обработчики предметов
		$this->execute("UPDATE `{{items}}` SET `php_class`='ItemBoxTest' WHERE `id`=1;");
		$this->execute("UPDATE `{{items}}` SET `php_class`='ItemPotionRed' WHERE `id`=2;");
		$this->execute("UPDATE `{{items}}` SET `php_class`='ItemPotion' WHERE `id`=3;");
		$this->execute("UPDATE `{{items}}` SET `php_class`='ItemScrollTest' WHERE `id`=4;");

	}

	public function safeDown()
	{
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `php_class`;");
		$this->execute("ALTER TABLE `{{player_items}}` DROP COLUMN `equipped`;");
	}

}