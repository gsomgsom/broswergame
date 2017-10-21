<?php

/**
 * UserIdentity описывает данные, необходимые для идентификации пользователя в системе.
 * Описывает метод идентификации пользователя по указанным данным.
 */
class UserIdentity extends CUserIdentity {
	const ERROR_EMAIL_INVALID = 3;

	private $_id;
	public $email;

	public function __construct($email, $password) {
		$this->email = $email;
		$this->password = $password;
	}

	public function authenticate() {
		$record = User::model()->find('LOWER(email)=?',[strtolower($this->email)]);
		if ($record === null) {
			$this->errorCode = self::ERROR_EMAIL_INVALID;
		}
		else if (!CPasswordHelper::verifyPassword($this->password, $record->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else {
			$this->_id = $record->id;
			$this->setState('email', $record->email);
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId() {
		return $this->_id;
	}

	public function getName() {
		return $this->email;
	}

}