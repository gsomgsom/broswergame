<?php

class m171107_191100_add_table_and_data_sectionsforum extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("CREATE TABLE IF NOT EXISTS `{{sectionsforum}}` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`alias` varchar(255) NOT NULL,
			`title` varchar(255) NOT NULL,
			`img` text NOT NULL COMMENT 'иконка',
			`description` varchar(500) NOT NULL COMMENT 'краткое описание',
			`order` int(11) NOT NULL DEFAULT '0',
			`visible` int(1) NOT NULL DEFAULT '1',
			PRIMARY KEY (`id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='разделы/категории форума';");

		$this->execute("INSERT INTO `{{sectionsforum}}` (`id`, `alias`, `title`, `img`, `description`, `order`, `visible`) VALUES
			(1, 'i1-izobretalna', 'Изобретальня', '', 'Любя, съешь щипцы, — вздохнёт мэр, — кайф жгуч. Шеф взъярён тчк щипцы с эхом гудбай Жюль. Эй, жлоб! Где туз? Прячь юных съёмщиц в шкаф. Экс-граф?', 0, 1),
			(2, 'i2-bardikishmel', 'Бар \"Дикий Шмель\"', '', 'Плюш изъят. Бьём чуждый цен хвощ! Эх, чужак! Общий съём цен шляп (юфть) — вдрызг! Любя, съешь щипцы, — вздохнёт мэр, — кайф жгуч. Шеф взъярён тчк щипцы с эхом гудбай Жюль. Эй, жлоб! Где туз? Прячь юных съёмщиц в шкаф.', 0, 1),
			(3, 'i3-sovetosnovatelei', 'Совет Основателей', '', 'Экс-граф? Плюш изъят. Бьём чуждый цен хвощ! Эх, чужак! Общий съём цен шляп (юфть) — вдрызг!', 0, 1),
			(4, 'i4-priemnaya', 'Приёмная', '', 'Любя, съешь щипцы, — вздохнёт мэр, — кайф жгуч. Шеф взъярён тчк щипцы с эхом гудбай Жюль. Эй, жлоб! Где туз? Прячь юных съёмщиц в шкаф.', 0, 1);");

	}

	public function safeDown()
	{
		$this->execute("DROP TABLE `{{sectionsforum}}`;");
	}

}