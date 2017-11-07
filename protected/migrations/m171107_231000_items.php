<?php

class m171107_231000_items extends CDbMigration
{
	public function safeUp()
	{
        $this->insert("{{items}}", array(
            "id"=>"9",
            "name"=>"Красный свиток",
            "php_class"=>"ItemScrollTest",
            "img"=>"scroll_red",
            "description"=>"Колдует что-то там. Пока не разобрались, что именно.",
            "notice"=>null,
            "use_text"=>"прочесть",
            "use_link"=>null,
            "bag"=>"collects",
            "class"=>"border-dark",
            "required_lvl"=>"1",
            "stack"=>"5",
            "use_stack"=>"1",
            "bag_limit"=>"1000",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"10",
            "name"=>"Квадратная академическая шапочка",
            "php_class"=>"ItemStudentHat",
            "img"=>"helm_student_hat",
            "description"=>"Головной убор, состоящий из квадратной горизонтальной доски, закреплённой на ермолке, и прикреплённой к её центру кисточки. Вместе с мантией составляет <b>торжественное одеяние выпускников вузов</b>.",
            "notice"=>null,
            "use_text"=>null,
            "use_link"=>null,
            "bag"=>"helm",
            "class"=>"border-success",
            "required_lvl"=>"1",
            "stack"=>"1",
            "use_stack"=>"1",
            "bag_limit"=>"0",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

        $this->insert("{{items}}", array(
            "id"=>"11",
            "name"=>"Академическая мантия",
            "php_class"=>"ItemStudentMantle",
            "img"=>"cloak_student_mantle",
            "description"=>"Академическая одежда является историческим традиционным одеянием, носимым в академическом обществе. Вместе с академической шапочкой составляет <b>торжественное одеяние выпускников вузов</b>.",
            "notice"=>null,
            "use_text"=>null,
            "use_link"=>null,
            "bag"=>"cloak",
            "class"=>"border-success",
            "required_lvl"=>"1",
            "stack"=>"1",
            "use_stack"=>"1",
            "bag_limit"=>"0",
            "variant"=>null,
            "nosell"=>"1",
            "default_quality"=>"5",
        ) );

	}

	public function safeDown()
	{
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=11;");
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=10;");
		$this->execute("DELETE FROM `{{items}}` WHERE `id`=9;");
	}

}