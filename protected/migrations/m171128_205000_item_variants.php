<?php

class m171128_205000_item_variants extends CDbMigration
{
	public function safeUp()
	{
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

		$this->execute("ALTER TABLE `{{items}}` CHANGE COLUMN `variant` `variants` VARCHAR(500) NULL DEFAULT NULL AFTER `bag_limit`;");
		$this->execute("ALTER TABLE `{{items}}`
			ADD COLUMN `str` INT(11) NOT NULL DEFAULT '0' AFTER `quality`,
			ADD COLUMN `def` INT(11) NOT NULL DEFAULT '0' AFTER `str`,
			ADD COLUMN `dex` INT(11) NOT NULL DEFAULT '0' AFTER `def`,
			ADD COLUMN `sta` INT(11) NOT NULL DEFAULT '0' AFTER `dex`,
			ADD COLUMN `int` INT(11) NOT NULL DEFAULT '0' AFTER `sta`;
		");

        $this->createTable("{{item_variants}}", 
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "title"=>"varchar(200)",
            "effect"=>"varchar(200)",
            "class"=>"varchar(200)",
            "str"=>"int(11) NOT NULL DEFAULT '0'",
            "def"=>"int(11) NOT NULL DEFAULT '0'",
            "dex"=>"int(11) NOT NULL DEFAULT '0'",
            "sta"=>"int(11) NOT NULL DEFAULT '0'",
            "int"=>"int(11) NOT NULL DEFAULT '0'",
            "visible"=>"int(11) unsigned NOT NULL DEFAULT '1'",
            ), 
        $options);

        $this->insert("{{item_variants}}", array(
            "id"=>"1",
            "title"=>"с печатью бандита",
            "effect"=>"Если надето: Вы выглядите, как бомж. Ладно, не пахните как он.",
            "class"=>null,
            "str"=>"0",
            "def"=>"0",
            "dex"=>"1",
            "sta"=>"1",
            "int"=>"0",
            "visible"=>"1",
        ) );

        $this->insert("{{item_variants}}", array(
            "id"=>"2",
            "title"=>"с печатью шмеля",
            "effect"=>"Если надето: Вы выглядите, как бомж. Ладно, не пахните как он.",
            "class"=>null,
            "str"=>"1",
            "def"=>"0",
            "dex"=>"0",
            "sta"=>"1",
            "int"=>"0",
            "visible"=>"1",
        ) );

        $this->insert("{{item_variants}}", array(
            "id"=>"3",
            "title"=>"с печатью стрекозы",
            "effect"=>"Если надето: Вы выглядите, как бомж. Ладно, не пахните как он.",
            "class"=>null,
            "str"=>"1",
            "def"=>"0",
            "dex"=>"1",
            "sta"=>"1",
            "int"=>"0",
            "visible"=>"1",
        ) );

        $this->insert("{{item_variants}}", array(
            "id"=>"4",
            "title"=>"с печатью осы",
            "effect"=>"Если надето: Вы выглядите, как бомж. Ладно, не пахните как он.",
            "class"=>null,
            "str"=>"0",
            "def"=>"0",
            "dex"=>"1",
            "sta"=>"0",
            "int"=>"1",
            "visible"=>"1",
        ) );

        $this->insert("{{item_variants}}", array(
            "id"=>"5",
            "title"=>"с печатью волшебника",
            "effect"=>"Если надето: Вы выглядите, как бомж. Ладно, не пахните как он.",
            "class"=>null,
            "str"=>"0",
            "def"=>"0",
            "dex"=>"0",
            "sta"=>"0",
            "int"=>"2",
            "visible"=>"1",
        ) );

        $this->insert("{{item_variants}}", array(
            "id"=>"6",
            "title"=>"с печатью колибри",
            "effect"=>"Если надето: Вы выглядите, как бомж. Ладно, не пахните как он.",
            "class"=>null,
            "str"=>"0",
            "def"=>"0",
            "dex"=>"2",
            "sta"=>"0",
            "int"=>"0",
            "visible"=>"1",
        ) );

        $this->insert("{{item_variants}}", array(
            "id"=>"7",
            "title"=>"с печатью защитника",
            "effect"=>"Если надето: Вы выглядите, как бомж. Ладно, не пахните как он.",
            "class"=>null,
            "str"=>"0",
            "def"=>"1",
            "dex"=>"0",
            "sta"=>"1",
            "int"=>"0",
            "visible"=>"1",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"18",
            "name"=>"Ветошь новобранца",
            "php_class"=>"ItemEquip",
            "img"=>"shirt_novice",
            "description"=>"Грубо скорена. Неказиста. Но лучше так, чем голышом.",
            "notice"=>null,
            "use_text"=>"надеть",
            "use_link"=>null,
            "bag"=>"equip",
            "type"=>"shirt",
            "class"=>"border-primary",
            "required_lvl"=>"1",
            "stack"=>"1",
            "use_stack"=>"0",
            "bag_limit"=>"0",
            "variants"=>"1,2,3,4,5,6,7",
            "nosell"=>"1",
            "quality"=>"2",
            "str"=>"0",
            "def"=>"0",
            "dex"=>"0",
            "sta"=>"1",
            "int"=>"0",
            "price_sell_coins"=>"125",
            "price_sell_nuts"=>"2",
            "price_sell_mushrooms"=>"1",
        ) );
	}

	public function safeDown()
	{
		$this->execute("DROP TABLE `{{item_variants}}`;");
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=18;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `str`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `def`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `dex`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `sta`;");
		$this->execute("ALTER TABLE `{{items}}` DROP COLUMN `int`;");
		$this->execute("ALTER TABLE `{{items}}` CHANGE COLUMN `variants` `variant` VARCHAR(500) NULL DEFAULT NULL AFTER `bag_limit`;");
	}

}