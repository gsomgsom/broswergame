<?php
class m171023_016000_player_log extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Schema for table 'g_log_types'
        $this->createTable("{{log_types}}", 
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "alias"=>"varchar(200)",
            "title"=>"varchar(200)",
            ), 
        $options);

        // Schema for table 'g_player_logs'
        $this->createTable("{{player_logs}}", 
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "player_id"=>"int(11) unsigned",
            "type_id"=>"int(11) unsigned",
            "dt"=>"datetime",
            "html"=>"varchar(5000)",
            ), 
        $options);

        // Indexs Keys for table 'g_player_logs'
        $this->createIndex('FK_g_player_logs_g_players','{{player_logs}}','player_id',false); 
        $this->createIndex('FK_g_player_logs_g_log_types','{{player_logs}}','type_id',false); 

        // Foreign Keys for table 'g_player_logs'
        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):
            $this->addForeignKey('fk_g_player_logs_g_log_types_type_id', '{{player_logs}}', 'type_id', '{{log_types}}', 'id', 'CASCADE','CASCADE'); 
            $this->addForeignKey('fk_g_player_logs_g_players_player_id', '{{player_logs}}', 'player_id', '{{players}}', 'id', 'CASCADE','CASCADE'); 
        endif;

        // Data for table 'g_log_types'
        $this->insert("{{log_types}}", array(
            "id"=>"1",
            "alias"=>"common",
            "title"=>"Общие",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"2",
            "alias"=>"debug",
            "title"=>"Отладочная информация",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"3",
            "alias"=>"system",
            "title"=>"Систменые сообщения",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"4",
            "alias"=>"resources",
            "title"=>"Ресурсы",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"5",
            "alias"=>"actions",
            "title"=>"Занятость",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"6",
            "alias"=>"items",
            "title"=>"Предметы",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"7",
            "alias"=>"effects",
            "title"=>"Эффекты",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"8",
            "alias"=>"war",
            "title"=>"Бои",
        ) );

        $this->insert("{{log_types}}", array(
            "id"=>"9",
            "alias"=>"achievments",
            "title"=>"Достижения",
        ) );

        // Data for table 'g_player_logs'
        $this->insert("{{player_logs}}", array(
            "id"=>"1",
            "player_id"=>"1",
            "type_id"=>"4",
            "dt"=>"2017-10-24 02:03:14",
            "html"=>"Что-то произошло. Вы получили <b>200</b> <img src=\"/assets/img/coins16.png\" title=\"монеты\"> <b>монет</b>.",
        ) );

        $this->insert("{{player_logs}}", array(
            "id"=>"2",
            "player_id"=>"1",
            "type_id"=>"4",
            "dt"=>"2017-10-24 02:04:08",
            "html"=>"Что-то произошло. Вы получили <b>15</b> <img src=\"/assets/img/nuts16.png\" title=\"жёлуди\"> <b>желудей</b>.",
        ) );

        $this->insert("{{player_logs}}", array(
            "id"=>"3",
            "player_id"=>"1",
            "type_id"=>"4",
            "dt"=>"2017-10-24 02:05:01",
            "html"=>"Что-то произошло. Вы получили <b>2</b> <img src=\"/assets/img/mushrooms16.png\" title=\"волшебные грибы\"> <b>волшебных гриба</b>.",
        ) );

        $this->insert("{{player_logs}}", array(
            "id"=>"4",
            "player_id"=>"1",
            "type_id"=>"3",
            "dt"=>"2017-10-24 02:08:20",
            "html"=>"<span style=\"color: red;\"><strong>Системное сообщение.</strong> На альфе будет появляться гораздо чаще, чем в релизе. Броадкаст, вообщем.</span>",
        ) );

	}

	public function safeDown() {
		$this->dropTable("{{player_logs}}");
		$this->dropTable("{{log_types}}");
	}

}
