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
	public $invite;

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['email, password, password_again', 'required'],
			['invite', 'required', 'on' => 'invite'],
			['invite', 'validateInvite', 'on' => 'invite'],
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
			'invite'        => 'Код приглашения',
			'password'      => 'Пароль',
			'password_again'=> 'Пароль повторно',
		];
	}

	/**
	 * Валидатор кода приглашения
	 */
	public function validateInvite($attribute) {
		if ($this->invite != 'pernatsk') {
			$this->addError($attribute, 'Код приглашения указан неверно');
		}
	}

	/**
	 * Действие перед валидацией
	 */
	protected function beforeValidate() {
		$this->email = trim($this->email);

		return parent::beforeValidate();
	}

}
