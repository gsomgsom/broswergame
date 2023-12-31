<?php
class m171022_012439_news extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Schema for table 'g_news'
        $this->createTable("{{news}}",
            array(
            "id"=>"int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "publicated"=>"int(11) NOT NULL DEFAULT '0'",
            "alias"=>"varchar(200)",
            "dt"=>"datetime",
            "title"=>"varchar(200)",
            "content"=>"longtext",
            ), 
        $options);

        // Data for table 'g_news'
        $this->insert("{{news}}", array(
            "id"=>"1",
            "publicated"=>"1",
            "alias"=>"first-news-entry",
            "dt"=>"2017-10-22 00:40:18",
            "title"=>"Самая первая новость",
            "content"=>"<img src=\"/assets/img/logo.png\"><br>
<p>Определились по концепту.</p>
<p>Игра повествует о жизни крошечных лесных человечков, которые по легендам населяют леса волшебной страны, вдали от чьих либо глаз. Человечки именуют себя \"Лесняне\" (?). Но не всё так просто в лесу.<br>

Народец живёт в дружбе и согласии с лесом и его обитателями.<br>
Вот только между собой конфликтует. И как тут не конфликтовать?<br>
Племя \"Мерзяки\" (?) постоянно пакостит племени \"Мируны\" (?). Вдобавок ко всему, они сделают всё, чтобы лес окутала тьма.<br>
Создания тьмы против народа света. Кто победит? Решать вам!</p>

<h4>Две фракции - \"Мерзяки\" и \"Мируны\".</h4>
<p>Выбор фракции на 10 уровне (нубский порог).<br>
Прокачка до 50 уровня. Каждые 10 уровней открывается особая абилка.<br>
На последнем уровне игроки соревнуются в шмоте и борются на аренах.<br>
Игра напоминает WoW своей функциональностью (охота на мобов, квесты, дикое пвп, подземелья, зоны боёв, арены, рейды).<br>
В игре предусмотрена торговля, профессии, крафт, заточки, ачивки, мини-игры и ивенты.<br>
Донат поначалу должен расходоваться на приобретение неигровых ништяков, например уникальных аватаров, рамок.<br>
Чуть позже приобрести можно будет донатную валюту, за которую можно будет ускорять занятия и профессии.<br>
Кроме того за донатную валюту можно будет приобрести ивентовые расходники.<br>
Ачивки за донат купить напрямую нельзя. Это обязательное условие.</p>
<h4>Прокачка характеристик.</h4>
<p>В отличие от БК-подобных игр, пернатска, мосвара и ботвы, характеристики персонажа качаются только шмотками.<br>
Ещё у персонажа есть дерево развития, благодаря которому он приобретает характеристики классов.<br>
Можно сделать как смешанный класс, так и гибридный, успешно сочетая до двух, а то и трёх разных направленностей.<br>
Сочетаний распределений баллов может быть достаточно много, так что билд у каждого получится свой.<br>
Во время развития персонаж получает 50 баллов развития (которые можно потратить, начиная с 10 уровня после выбора фракции).</p>
<p>Предусмотрено расширение игры в случае успеха. Кап уровня повышается на +10 (до 60-го).<br>
Дерево развития приобретает особую ветку, на которой можно потратить ещё 5 баллов в нескольких направлениях.<br>
Остальные 5 баллов можно вложить в старые направления.</p>
<h4>Валюта.</h4>
<p><img src=\"/assets/img/coins16.png\" title=\"монеты\"> <b>Монеты</b> - простая валюта.<br>
<img src=\"/assets/img/nuts16.png\" title=\"жёлуди\"> <b>Жёлуди</b> - вторая валюта.<br>
<img src=\"/assets/img/mushrooms16.png\" title=\"волшебные грибы\"> <b>Волшебные грибы</b> - донат валюта.</p>
<p>По сути все расчёты в игре ведутся в монетах. Некоторые более ценные расчёты ведутся в желудях.<br>
И наконец, волшебные грибы являются самой ценной валютой, которую можно разменять на первые две.<br>
Ценность валюты будет сбалансирована опытным путём в ходе тестирования.</p>
<h4>Предметы.</h4>
<p>В игре будет система предметов, аналогичная wow. Ранец будет дополняться сумками объединёнными в общее хранилище.<br>
Расходники будут храниться в кармашках основного ранца, не занимая основного места.</p>
<p>Система лута будет подобной wow. С мобов и боссов будут падать с установленной вероятностью различные предметы.<br>
Некоторые предметы необходимо будет фармить. Фарм локаций будет похож на лабиринт, но с возможностью пройти его автоматически за жёлуди либо за грибы.</p>
<p>Здоровье будет восстанавливаться во время сна либо зельями. Само оно не восстанавливается.</p>
<h4>Мировое ПвП.</h4>
<p>Возможно только при занятии персонажем каким-либо делом. Например, напасть можно только на фармящего либо работающего персонажа. Конечно можно выйти на арену и сражаться там друг с другом.<br>
На бездельников можно напасть только имея заказ на персонажа.</p>
<h4>Проведение тестирования</h4>
<p>Во время альфа-теста, персонажи смогут относительно легко проверять локации, эффекты и механики, используя специальные игровые предметы, упрощающие доступ к локациям или их прохождение. Таким образом будет реализован механизм “чит-кодов” а также тестирования и отладки игры игроками.<br>
Зелья с эффектами будут снимать на время ограничения к прохождению локаций или кулдауны на локациях.</p>

",
        ) );

	}

	public function safeDown() {
		$this->dropTable("{{news}}");
	}

}
