<?php

/**
 * Модель "SigninForm"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Форма записи на тест
 */

class SigninForm extends CFormModel {
	public $email;

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['email', 'required'],
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
			'email'=>'E-mail',
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
