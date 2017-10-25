<?php

class m171025_230554_player_states extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Schema for table 'g_player_states'
        $this->createTable("{{player_states}}", 
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "player_id"=>"int(11) unsigned",
            "alias"=>"varchar(64)",
            "state_int"=>"int(11) unsigned",
            "state_text"=>"varchar(64)",
            "cooldown"=>"timestamp",
            ), 
        $options);

        // Indexs Keys for table 'g_player_states'
        $this->createIndex('player_state_key','{{player_states}}','player_id,alias',true); 
        $this->createIndex('FK_g_player_states_g_players','{{player_states}}','player_id',false); 

        // Foreign Keys for table 'g_player_states'
        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):
            $this->addForeignKey('fk_g_player_states_g_players_player_id', '{{player_states}}', 'player_id', '{{players}}', 'id', 'CASCADE','CASCADE'); 
        endif;

	}

	public function safeDown() {
		$this->dropTable("{{player_states}}");
	}

}
