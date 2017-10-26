<?php

class UserForm extends CFormModel {
	public $email;
	public $password;
	public $password_again;
	public $licenseAccepted;

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

	public function attributeLabels() {
		return [
			'email'         => 'E-mail',
			'password'      => 'Пароль',
			'password_again'=> 'Пароль повторно',
		];
	}

	protected function beforeValidate() {
		$this->email = trim($this->email);

		return parent::beforeValidate();
	}

}
