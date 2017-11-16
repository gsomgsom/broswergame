<?php

class m171117_014200_log_type_level extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("UPDATE `{{log_types}}` SET `alias`='level', `title`='Уровень' WHERE `alias`='items';");
		$this->execute("ALTER TABLE `{{players}}` ADD COLUMN `last_action` DATETIME NULL DEFAULT NULL AFTER `carma`;");
	}

	public function safeDown()
	{
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `last_action`;");
		$this->execute("UPDATE `{{log_types}}` SET `alias`='items', `title`='Предметы' WHERE `alias`='level';");
	}

}