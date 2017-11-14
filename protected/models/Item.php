<?php

/**
 * Модель "Item"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Предмет. Всё что связано с предметами и действиями над ним.
 */

class Item extends BaseModel {
	// Качество предметов - значения кодов
	const QUALITY_POOR             = 0;
	const QUALITY_COMMON           = 1;
	const QUALITY_UNCOMMON         = 2;
	const QUALITY_RARE             = 3;
	const QUALITY_EPIC             = 4;
	const QUALITY_ARTIFACT         = 5;

	// Качество предметов - названия
	const QUALITY_POOR_TEXT        = 'хлам';
	const QUALITY_COMMON_TEXT      = 'обычный';
	const QUALITY_UNCOMMON_TEXT    = 'необычный';
	const QUALITY_RARE_TEXT        = 'редкий';
	const QUALITY_EPIC_TEXT        = 'эпический';
	const QUALITY_ARTIFACT_TEXT    = 'артифакт';

	// Качество предметов - цвета
	const QUALITY_POOR_COLOR       = '#555';
	const QUALITY_COMMON_COLOR     = '#aaa';
	const QUALITY_UNCOMMON_COLOR   = '#083';
	const QUALITY_RARE_COLOR       = '#229';
	const QUALITY_EPIC_COLOR       = '#707';
	const QUALITY_ARTIFACT_COLOR   = '#c82';

	public function __construct() {
		$this->name = 'Пусто';
		$this->description = 'Пустое';
		$this->img = 'empty';
		$this->quality = self::QUALITY_COMMON;
	}

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{items}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['name', 'safe'],					// название предмета
			['php_class', 'safe'],				// php - класс, в котором описано поведение предмета (use, unuse, sell, buy, loot...)
			['img', 'safe'],					// картинка (возможно при компиляции спрайтов будет означать класс картинки)
			['description', 'safe'],			// текстовое описание
			['notice', 'safe'],					// примечание к описанию (выводится курсивом), обычно пусто
			['use_text', 'safe'],				// текст на кнопке "открыть", "выпить", и т.д.
			['use_link', 'safe'],				// ссылка на использование, как правило ссылка на локацию или null
			['bag', 'safe'],					// отдел сумки, где лежит
			['type', 'safe'],					// тип предмета, trash, collect, container, consumable, helm, cloak...
			['class', 'safe'],					// css - класс
			['required_lvl', 'safe'],			// требуемый уровень для пользования предметом
			['use_stack', 'safe'],				// за раз используется use_stack предметов
			['stack', 'safe'],					// предметов в стопке (если предмет не собирается в стопке, то 1)
			['bag_limit', 'safe'],				// лимит предметов в сумке у игрока
			['nosell', 'safe'],					// предмет не подлежит продаже
			['quality', 'safe'],				// качество предмета по-умолчанию
			['price_sell_coins', 'safe'],		// цена продажи в магазин, монеты
			['price_sell_nuts', 'safe'],		// цена продажи в магазин, жёлуди
			['price_sell_mushrooms', 'safe'],	// цена продажи в магазин, грибы
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [];
	}

	/**
	 * Названия полей таблицы
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'id' => 'id',
		];
	}

	/**
	 * Возвращает экземпляр себя
	 * @return CActiveRecord объект модели
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Описывает скоупы (scopes), сокращения предустановок выборки
	 * @return array
	 */
	public function scopes() {
		return [
			'sorted' => ['order' => 'id ASC'],
		];
	}

	/**
	 * Действие перед сохранением в БД
	 * @return bool
	 */
	public function beforeSave() {
		if (parent::beforeSave()) {
			// @TODO
			return true;
		}
		else
			return false;
	}

	/**
	 * Возвращает качество предметов, по значению кода $quality, текст
	 * @quality integer Код качества предмета
	 * @return string
	 */
	public static function getQualityText($quality) {
		if ($quality == self::QUALITY_POOR) {
			return self::QUALITY_POOR_TEXT;
		}
		elseif ($quality == self::QUALITY_COMMON) {
			return self::QUALITY_COMMON_TEXT;
		}
		elseif ($quality == self::QUALITY_UNCOMMON) {
			return self::QUALITY_UNCOMMON_TEXT;
		}
		elseif ($quality == self::QUALITY_RARE) {
			return self::QUALITY_RARE_TEXT;
		}
		elseif ($quality == self::QUALITY_EPIC) {
			return self::QUALITY_EPIC_TEXT;
		}
		elseif ($quality == self::QUALITY_ARTIFACT) {
			return self::QUALITY_ARTIFACT_TEXT;
		}
		else {
			return self::QUALITY_POOR_TEXT;
		}
	}

	/**
	 * Возвращает цвет предметов, по значению кода $quality, HTML-цвет
	 * @quality integer Код качества предмета
	 * @return string
	 */
	public static function getQualityColor($quality) {
		if ($quality == self::QUALITY_POOR) {
			return self::QUALITY_POOR_COLOR;
		}
		elseif ($quality == self::QUALITY_COMMON) {
			return self::QUALITY_COMMON_COLOR;
		}
		elseif ($quality == self::QUALITY_UNCOMMON) {
			return self::QUALITY_UNCOMMON_COLOR;
		}
		elseif ($quality == self::QUALITY_RARE) {
			return self::QUALITY_RARE_COLOR;
		}
		elseif ($quality == self::QUALITY_EPIC) {
			return self::QUALITY_EPIC_COLOR;
		}
		elseif ($quality == self::QUALITY_ARTIFACT) {
			return self::QUALITY_ARTIFACT_COLOR;
		}
		else {
			return self::QUALITY_POOR_COLOR;
		}
	}

	/**
	 * Использование предмета
	 * В наследующихся классах требуется описать действие по 'use'
	 * @player_item PlayerItems Экземпляр предмета
	 * @amount integer Количество
	 * @return array
	 */
	public function useItem($player_item, $amount) {
		// Пишем в лог
		Funcs::logMessage('Используем предмет '.$player_item->id.':'.$player_item->item->id.' &laquo;'.$player_item->item->name.'&raquo; ('.$amount.')');

		if ($player_item->player->lvl >= $player_item->item->required_lvl) {
			if ($player_item->amount >= $player_item->item->use_stack) {
				$player_item->player->removeItem($player_item->item_id, $player_item->item->use_stack);
				Yii::app()->user->setFlash('success', Yii::t('error', '__item__used'));
				return true;
			}
			else {
				Yii::app()->user->setFlash('error', Yii::t('error', '__item__used_need_amount', [
					'{amount}' => $player_item->item->use_stack,
				]));
				return false;
			}
		}
		else {
			Yii::app()->user->setFlash('error', Yii::t('error', '__item__used_need_lvl'));
			return false;
		}
		return true;
	}

	/**
	 * Возвращает HTML-текст с названием, иконкой и количеством предмета для вывода в лог
	 * @amount integer Количество
	 * @return string HTML
	 */
	public function getLogText($amount = 1) {
		$usedAmount = '';
		if ($amount > 1) {
			$usedAmount = ' x '.$amount;
		}
		return '<img src="/assets/img/'.$this->img.'16.png" title="'.$this->name.'"> <b>'.$this->name.'</b>'.$usedAmount;
	}

}
