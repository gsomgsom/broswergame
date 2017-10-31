<?php

/**
 * Модель "UserForm"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Форма регистрации - пользователь
 */

class UserForm extends CFormModel {
	public $email;
	public $password;
	public $password_again;
	public $licenseAccepted;

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['email, password, password_again', 'required'],
			['licenseAccepted', 'required', 'requiredValue' => 1, 'message' => 'Вы <b>не подтвердили</b> условия регистрации'],
			['password', 'compare', 'compareAttribute' => 'password_again'],
			['password, email', 'length', 'max' => 128],
			['password', 'length', 'min' => 5],
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
			'password'      => 'Пароль',
			'password_again'=> 'Пароль повторно',
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
