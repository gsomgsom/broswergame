<?php

/**
 * Модель "EmailForm"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Форма смены учётных данных - e-mail
 */

class EmailForm extends CFormModel {
	public $email;

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['email', 'required'],
			['email', 'length', 'max' => 128],
			['email', 'email'],
			['email', 'unique', 'className'=>'User', 'attributeName'=>'email'],
		];
	}

	/**
	 * Названия полей таблицы
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'email'         => 'E-mail',
		];
	}

	/**
	 * Действие перед валидацией
	 */
	protected function beforeValidate() {
		$this->email = trim($this->email);

		return parent::beforeValidate();
	}

}
