<?php

class m171109_191300_create_topicsforum extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("CREATE TABLE IF NOT EXISTS `{{topicsforum}}` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`alias` varchar(255) NOT NULL,
			`title` varchar(255) NOT NULL,
			`visible` int(1) NOT NULL DEFAULT '1',
			`order` int(11) NOT NULL DEFAULT '0',
			`section_id` int(11) DEFAULT NULL,
			`fixed` int(1) NOT NULL DEFAULT '0' COMMENT 'закреплена',
			`closed` int(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`),
			KEY `FK_g_topicsforum_g_sectionsforum` (`section_id`),
			CONSTRAINT `FK_g_topicsforum_g_sectionsforum` FOREIGN KEY (`section_id`) REFERENCES `g_sectionsforum` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
		  ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='темы на форуме';");
		$this->execute("INSERT INTO `{{topicsforum}}` (`id`, `alias`, `title`, `visible`, `order`, `section_id`, `fixed`, `closed`) VALUES
			(1, 'i1-svobodapopugaim', 'Свободу попугаям', 1, 0, 1, 0, 0),
			(2, 'i2-mifiipoveria', 'Мифы и поверья', 1, 0, 1, 0, 0),
			(3, 'i3-russkaiajarptica', 'Русская Жарптица', 1, 0, 2, 0, 0),
			(4, 'i4-obmen', 'Обмен', 1, 0, 1, 0, 0),
			(5, 'i5-kupliy', 'Куплю', 1, 0, 1, 0, 0),
			(6, 'i6-prodam', 'Продам', 1, 0, 1, 0, 0),
			(7, 'i7-tumanchik', 'Туманчик', 1, 0, 2, 0, 0);");
	}

	public function safeDown()
	{
		$this->dropTable("{{topicsforum}}");
	}

}