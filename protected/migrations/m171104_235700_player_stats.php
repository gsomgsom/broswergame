<?php

class m171104_235700_player_stats extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("ALTER TABLE `{{players}}`
	ADD COLUMN `exp` INT UNSIGNED NULL DEFAULT '0' AFTER `lvl`,
	ADD COLUMN `hp` INT UNSIGNED NULL DEFAULT '0' AFTER `exp`,
	ADD COLUMN `str` INT UNSIGNED NULL DEFAULT '1' AFTER `mushrooms`,
	ADD COLUMN `def` INT UNSIGNED NULL DEFAULT '1' AFTER `str`,
	ADD COLUMN `dex` INT UNSIGNED NULL DEFAULT '1' AFTER `def`,
	ADD COLUMN `sta` INT UNSIGNED NULL DEFAULT '1' AFTER `dex`,
	ADD COLUMN `int` INT UNSIGNED NULL DEFAULT '1' AFTER `sta`,
	ADD COLUMN `might` INT UNSIGNED NULL DEFAULT '0' AFTER `int`,
	ADD COLUMN `carma` INT NULL DEFAULT '0' AFTER `might`;");
	}

	public function safeDown()
	{
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `exp`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `hp`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `str`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `def`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `dex`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `sta`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `int`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `might`;");
		$this->execute("ALTER TABLE `{{players}}` DROP COLUMN `carma`;");
	}

}