<?php

class m171110_113800_log_hidden extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("ALTER TABLE `{{log_types}}`
			ADD COLUMN `visible` INT UNSIGNED NOT NULL DEFAULT '1' AFTER `title`;
		");
		$this->execute("UPDATE `{{log_types}}` SET `visible`='0' WHERE `id`=2;");
	}

	public function safeDown()
	{
		$this->execute("ALTER TABLE `{{log_types}}` DROP COLUMN `visible`;");
	}

}