<?php

class m171117_020437_achievments extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Schema for table '{{achievments}}'
        $this->createTable("{{achievments}}", 
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "alias"=>"varchar(200)",
            "title"=>"varchar(200)",
            "requirement"=>"varchar(200)",
            "rank"=>"int(10) unsigned NOT NULL DEFAULT '1'",
            "val"=>"int(10) unsigned NOT NULL DEFAULT '1'",
            "visible"=>"int(10) unsigned NOT NULL DEFAULT '1'",
            ), 
        $options);

        // Schema for table '{{player_achievments}}'
        $this->createTable("{{player_achievments}}", 
            array(
            "id"=>"int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "player_id"=>"int(11) unsigned",
            "achievment_id"=>"int(11) unsigned",
            "dt"=>"datetime",
            ), 
        $options);

        // Indexs Keys for table '{{player_achievments}}'
        $this->createIndex('FK_player_achievments_players','{{player_achievments}}','player_id',false); 
        $this->createIndex('FK_player_achievments_achievments','{{player_achievments}}','achievment_id',false); 

        // Foreign Keys for table '{{player_achievments}}'
        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):
            $this->addForeignKey('fk_g_player_achievments_g_achievments_achievment_id', '{{player_achievments}}', 'achievment_id', '{{achievments}}', 'id', 'CASCADE','CASCADE'); 
            $this->addForeignKey('fk_g_player_achievments_g_players_player_id', '{{player_achievments}}', 'player_id', '{{players}}', 'id', 'CASCADE','CASCADE'); 
        endif;

        // Data for table '{{achievments}}'
        $this->insert("{{achievments}}", array(
            "id"=>"1",
            "alias"=>"lvl",
            "title"=>"Подрастайка",
            "requirement"=>"Достичь {val} уровня.",
            "rank"=>"1",
            "val"=>"10",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"2",
            "alias"=>"lvl",
            "title"=>"Подрастайка",
            "requirement"=>"Достичь {val} уровня.",
            "rank"=>"2",
            "val"=>"20",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"3",
            "alias"=>"lvl",
            "title"=>"Подрастайка",
            "requirement"=>"Достичь {val} уровня.",
            "rank"=>"3",
            "val"=>"30",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"4",
            "alias"=>"lvl",
            "title"=>"Подрастайка",
            "requirement"=>"Достичь {val} уровня.",
            "rank"=>"4",
            "val"=>"40",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"5",
            "alias"=>"lvl",
            "title"=>"Подрастайка",
            "requirement"=>"Достичь {val} уровня.",
            "rank"=>"5",
            "val"=>"50",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"6",
            "alias"=>"wheel",
            "title"=>"Крутильщик",
            "requirement"=>"Покрутить колесо фортуны {val} раз.",
            "rank"=>"1",
            "val"=>"1",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"7",
            "alias"=>"wheel",
            "title"=>"Крутильщик",
            "requirement"=>"Покрутить колесо фортуны {val} раз.",
            "rank"=>"2",
            "val"=>"50",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"8",
            "alias"=>"wheel",
            "title"=>"Крутильщик",
            "requirement"=>"Покрутить колесо фортуны {val} раз.",
            "rank"=>"3",
            "val"=>"250",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"9",
            "alias"=>"wheel",
            "title"=>"Крутильщик",
            "requirement"=>"Покрутить колесо фортуны {val} раз.",
            "rank"=>"4",
            "val"=>"1000",
            "visible"=>"1",
        ) );

        $this->insert("{{achievments}}", array(
            "id"=>"10",
            "alias"=>"wheel",
            "title"=>"Крутильщик",
            "requirement"=>"Покрутить колесо фортуны {val} раз.",
            "rank"=>"5",
            "val"=>"10000",
            "visible"=>"1",
        ) );

	}

	public function safeDown() {
		$this->dropTable("{{player_achievments}}");
		$this->dropTable("{{achievments}}");
	}

}
