<?php

class SigninForm extends CFormModel {
	public $email;

	public function rules() {
		return [
			['email', 'required'],
			['email', 'email'],
			['email', 'unique', 'className'=>'User', 'attributeName'=>'email'],
		];
	}

	public function attributeLabels() {
		return [
			'email'=>'E-mail',
		];
	}

	protected function beforeValidate() {
		$this->email = trim($this->email);

		return parent::beforeValidate();
	}

}
