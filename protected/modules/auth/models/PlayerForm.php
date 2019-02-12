<?php

/**
 * Модель "PlayerForm"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Форма регистрации - персонаж
 */

class PlayerForm extends CFormModel {
	public $nickname;
	public $gender = 1;

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['nickname', 'required'],
			['nickname', 'length', 'max' => 16],
			['nickname', 'length', 'min' => 3],
			//['nickname', 'match', 'pattern'=>'/^([a-zA-Zа-яА-ЯёЁ0-9_])+$/', 'message' => 'Ник может состоять из букв, цифр и знака подчёркивания.'],
			['nickname', 'unique', 'className'=>'Player', 'attributeName'=>'nickname'],
		];
	}

	/**
	 * Названия полей таблицы
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'nickname' => 'Ник в игре',
		];
	}

	/**
	 * Действие перед валидацией
	 */
	protected function beforeValidate() {
		$this->nickname = trim($this->nickname);

		return parent::beforeValidate();
	}

}
