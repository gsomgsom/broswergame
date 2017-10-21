<?php

class m171021_232852_db_schema extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Data for table 'g_users'
        $this->insert("{{users}}", array(
            "id"=>"1",
            "datereg"=>"2017-09-21 23:16:35",
            "password"=>"\$2a\$13\$PNR47YVHIhz.oCmdHAakVem7tJD8U6DWV8uheo4xat93b.O5IVUlC",
            "email"=>"zhelneen@yandex.ru",
            "role"=>"player",
            "forgot_hash"=>"6896521bf2c62949dbdfa65176cc45f9",
            "forgot_timeout"=>"2017-09-21 23:16:31",
            "last_action"=>"2017-10-21 23:22:42",
            "timezone"=>"Asia/Yekaterinburg",
        ) );

        // Data for table 'g_players'
        $this->insert("{{players}}", array(
            "id"=>"1",
            "user_id"=>"1",
            "nickname"=>"ИгрокНомерОдин",
            "lvl"=>"25",
            "coins"=>"999999999999",
            "nuts"=>"999999999999",
            "mushrooms"=>"999999999999",
        ) );

	}

	public function safeDown() {
		echo 'Migration down not supported.';
	}

}
