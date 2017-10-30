<?php

class m171031_022751_items extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Schema for table 'g_items'
        $this->createTable("{{items}}",
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "name"=>"varchar(128)",
            "img"=>"varchar(128)",
            "description"=>"varchar(1000)",
            "notice"=>"varchar(500)",
            "use_text"=>"varchar(128) DEFAULT 'актив.'",
            "use_link"=>"varchar(128)",
            "bag"=>"varchar(128) DEFAULT 'collects'",
            "class"=>"varchar(128) DEFAULT 'item'",
            "required_lvl"=>"int(11) unsigned NOT NULL DEFAULT '1'",
            "stack"=>"int(11) unsigned NOT NULL DEFAULT '1'",
            "use_stack"=>"int(11) unsigned NOT NULL DEFAULT '1'",
            "bag_limit"=>"int(11) unsigned NOT NULL DEFAULT '1'",
            "variant"=>"int(11) unsigned",
            "nosell"=>"int(11) unsigned NOT NULL DEFAULT '0'",
            "default_quality"=>"int(11) unsigned NOT NULL DEFAULT '5'",
            ), 
        $options);

        // Schema for table 'g_player_items'
        $this->createTable("{{player_items}}",
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "player_id"=>"int(11) unsigned",
            "item_id"=>"int(11) unsigned",
            "amount"=>"int(11) unsigned DEFAULT '1'",
            "quality"=>"int(11) unsigned DEFAULT '0'",
            "lvl"=>"int(11) unsigned DEFAULT '0'",
            "variant"=>"int(11) unsigned DEFAULT '0'",
            ), 
        $options);

        // Indexs Keys for table 'g_player_items'
        $this->createIndex('fk_player_items_player','{{player_items}}','player_id',false); 
        $this->createIndex('FK_g_player_items_g_items','{{player_items}}','item_id',false); 

        // Foreign Keys for table 'g_player_items'
        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):
            $this->addForeignKey('fk_g_player_items_g_items_item_id', '{{player_items}}', 'item_id', '{{items}}', 'id', 'CASCADE','CASCADE'); 
            $this->addForeignKey('fk_g_player_items_g_players_player_id', '{{player_items}}', 'player_id', '{{players}}', 'id', 'CASCADE','CASCADE'); 
        endif;

        // Data for table 'g_items'
        $this->insert("{{items}}", array(
            "id"=>"1",
            "name"=>"Подарок альфа-тестеру",
            "img"=>"present_box_striped",
            "description"=>"Судя по звуку, в коробочке что-то есть. И конечно очень ценное! Открыть! Срочно!",
            "notice"=>null,
            "use_text"=>"открыть",
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-success",
            "required_lvl"=>"1",
            "stack"=>"1000",
            "use_stack"=>"1",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"2",
            "name"=>"Красное зелье",
            "img"=>"potion_small_red",
            "description"=>"Восстанавливает здоровье до максимума",
            "notice"=>null,
            "use_text"=>"выпить",
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-primary",
            "required_lvl"=>"1",
            "stack"=>"5",
            "use_stack"=>"1",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"3",
            "name"=>"Синее зелье",
            "img"=>"potion_big_blue",
            "description"=>"Восстанавливает энергию до максимума",
            "notice"=>null,
            "use_text"=>"выпить",
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-primary",
            "required_lvl"=>"1",
            "stack"=>"5",
            "use_stack"=>"1",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"4",
            "name"=>"Синий свиток",
            "img"=>"scroll_blue",
            "description"=>"Колдует что-то там. Пока не разобрались, что именно.",
            "notice"=>null,
            "use_text"=>"прочесть",
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-dark",
            "required_lvl"=>"1",
            "stack"=>"5",
            "use_stack"=>"5",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"5",
            "name"=>"Ракушки",
            "img"=>"shells",
            "description"=>"Ценятся среди тех, у уого они - дефицит",
            "notice"=>null,
            "use_text"=>null,
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-secondary",
            "required_lvl"=>"1",
            "stack"=>"0",
            "use_stack"=>"1",
            "bag_limit"=>"100000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"6",
            "name"=>"Черепушки",
            "img"=>"skulls",
            "description"=>"Победителей не судят. Но между собой победители меряются. Чем? Правильно, Черепушками.",
            "notice"=>null,
            "use_text"=>null,
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-secondary",
            "required_lvl"=>"1",
            "stack"=>"0",
            "use_stack"=>"1",
            "bag_limit"=>"100000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"7",
            "name"=>"Побрякушки",
            "img"=>"diamonds",
            "description"=>"Сверкушки-побрякушки. И ещё лучшие друзья девушек. Ага.",
            "notice"=>null,
            "use_text"=>null,
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-warning",
            "required_lvl"=>"1",
            "stack"=>"0",
            "use_stack"=>"1",
            "bag_limit"=>"100000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"8",
            "name"=>"Мёд",
            "img"=>"honey",
            "description"=>"Сладкий, как победа над пчёлами, у которых его с таким трудом отобрали.",
            "notice"=>null,
            "use_text"=>null,
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-warning",
            "required_lvl"=>"1",
            "stack"=>"0",
            "use_stack"=>"1",
            "bag_limit"=>"100000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        // Data for table 'g_player_items'
        $this->insert("{{player_items}}", array(
            "id"=>"1",
            "player_id"=>"1",
            "item_id"=>"1",
            "amount"=>"1000",
            "quality"=>"5",
            "lvl"=>"0",
            "variant"=>"0",
        ) );

	}

	public function safeDown() {
		$this->dropTable("{{player_items}}");
		$this->dropTable("{{items}}");
	}

}
