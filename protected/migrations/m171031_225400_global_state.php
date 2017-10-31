<?php

class m171031_225400_global_state extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("ALTER TABLE `{{player_states}}` ADD COLUMN `is_global` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `alias`;");
	}

	public function safeDown()
	{
		$this->execute("ALTER TABLE `{{player_states}}` DROP COLUMN `is_global`;");
	}

}