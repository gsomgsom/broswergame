<?php

class m171102_001400_player_gender extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("ALTER TABLE `{{players}}` ADD COLUMN `gender` INT(11) UNSIGNED NOT NULL DEFAULT '1' AFTER `nickname`;");
	}

	public function safeDown()
	{
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `gender`;");
	}

}