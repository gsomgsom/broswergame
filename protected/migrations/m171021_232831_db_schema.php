<?php

class m171021_232831_db_schema extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Schema for table 'g_players'
        $this->createTable("{{players}}",
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "user_id"=>"int(11) unsigned",
            "nickname"=>"varchar(32) NOT NULL",
            "lvl"=>"int(11) NOT NULL DEFAULT '1'",
            "coins"=>"bigint(20) NOT NULL DEFAULT '0'",
            "nuts"=>"bigint(20) NOT NULL DEFAULT '0'",
            "mushrooms"=>"bigint(20) NOT NULL DEFAULT '0'",
            ), 
        $options);

        // Schema for table 'g_users'
        $this->createTable("{{users}}",
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "datereg"=>"datetime",
            "password"=>"varchar(128) NOT NULL",
            "email"=>"varchar(128) NOT NULL",
            "role"=>"enum('player','moderator','admin') NOT NULL DEFAULT 'player'",
            "forgot_hash"=>"varchar(128) DEFAULT '6896521bf2c62949dbdfa65176cc45f9'",
            "forgot_timeout"=>"timestamp NOT NULL",
            "last_action"=>"timestamp NULL DEFAULT NULL",
            "timezone"=>"varchar(100) DEFAULT 'Europe/Moscow'",
            ), 
        $options);

        // Indexs Keys for table 'g_players'
        $this->createIndex('unique_nickname','{{players}}','nickname',true); 
        $this->createIndex('fk_player_user','{{players}}','user_id',false); 

        // Indexs Keys for table 'g_users'
        $this->createIndex('email-index','{{users}}','email',true); 

        // Foreign Keys for table 'g_players'
        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):
            $this->addForeignKey('fk_g_players_g_users_user_id', '{{players}}', 'user_id', '{{users}}', 'id', Null,Null); 
        endif;

	}

	public function safeDown() {
		echo 'Migration down not supported.';
	}

}
