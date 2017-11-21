<?php

class m171122_021800_game_event_autumn extends CDbMigration
{
	public function safeUp()
	{
        $this->insert("{{items}}", array(
            "id"=>"14",
            "name"=>"Зелёный лист",
            "php_class"=>"ItemLeafGreen",
            "img"=>"leaf",
            "description"=>"Обычный зелёный лист. Правда, если собрать несколько зелёных листьев, то за них можно получить бесценный {exp} опыт.",
            "notice"=>null,
            "use_text"=>'собрать',
            "use_link"=>null,
            "bag"=>"collects",
            "type"=>"collect",
            "class"=>"border-secondary",
            "required_lvl"=>"1",
            "stack"=>"1000",
            "use_stack"=>"10",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "quality"=>"1",
            "price_sell_coins"=>"0",
            "price_sell_nuts"=>"0",
            "price_sell_mushrooms"=>"0",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"15",
            "name"=>"Красный лист",
            "php_class"=>"ItemLeafRed",
            "img"=>"leaf_red",
            "description"=>"Ничем не примечательный красный лист. Если собрать несколько красных листьев, то за них можно получить {item2}, а если повезёт, то и {item3}",
            "notice"=>null,
            "use_text"=>'собрать',
            "use_link"=>null,
            "bag"=>"collects",
            "type"=>"collect",
            "class"=>"border-secondary",
            "required_lvl"=>"1",
            "stack"=>"1000",
            "use_stack"=>"10",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "quality"=>"1",
            "price_sell_coins"=>"0",
            "price_sell_nuts"=>"0",
            "price_sell_mushrooms"=>"0",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"16",
            "name"=>"Золотой лист",
            "php_class"=>"ItemLeafGold",
            "img"=>"leaf_gold",
            "description"=>"Ярко сияющий золотом лист. Если собрать несколько этих редких листьев, то за них можно выручить целый {item1}",
            "notice"=>null,
            "use_text"=>'собрать',
            "use_link"=>null,
            "bag"=>"collects",
            "type"=>"collect",
            "class"=>"border-secondary",
            "required_lvl"=>"1",
            "stack"=>"1000",
            "use_stack"=>"10",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "quality"=>"1",
            "price_sell_coins"=>"0",
            "price_sell_nuts"=>"0",
            "price_sell_mushrooms"=>"0",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"17",
            "name"=>"Мёртвый лист",
            "php_class"=>"ItemLeafDead",
            "img"=>"leaf_dead",
            "description"=>"Гниющий лист. Впрочем даже за кучку этих тухнущих листьев можно получить {item14}, {item15} или {item16}",
            "notice"=>null,
            "use_text"=>'собрать',
            "use_link"=>null,
            "bag"=>"collects",
            "type"=>"collect",
            "class"=>"border-secondary",
            "required_lvl"=>"1",
            "stack"=>"1000",
            "use_stack"=>"10",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "quality"=>"1",
            "price_sell_coins"=>"0",
            "price_sell_nuts"=>"0",
            "price_sell_mushrooms"=>"0",
        ) );

		$this->execute("replace into {{player_states}} (player_id, alias, state_text, cooldown)
						select
							p.id as player_id, 'GameEventAutumn' as alias, 'spell' as state_text, '2017-12-01 00:00:00' as cooldown
						from g_players p;");
	}

	public function safeDown()
	{
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=14;");
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=15;");
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=16;");
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=17;");
		$this->execute("DELETE from `{{player_states}}` WHERE `alias`='GameEventAutumn';");
	}

}