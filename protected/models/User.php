<?php

class User extends CActiveRecord {

	public function tableName() {
		return '{{users}}';
	}

	public function rules() {
		return [
			['password, email', 'required'],
			['password, email', 'length', 'max' => 128],
			['role', 'in', 'range' => ['player','moderator','admin'], 'message' => 'Указана неизвестная роль'],
			['role, forgot_hash, forgot_timeout, datereg, last_action', 'safe'],
		];
	}

	public function relations() {
		return [
			'player' => [self::HAS_ONE, 'Player', ['user_id' => 'id']],
		];
	}

	public function attributeLabels() {
		return [
			'id'                => 'id',
			'password'          => 'Пароль',
			'email'             => 'Email',
			'role'              => 'Роль',
		];
	}

	/**
	 * Проверяем валидность пароля
	 * @param string пароль
	 * @return boolean результат проверки
	 */
	public function validatePassword($password) {
		return CPasswordHelper::verifyPassword($password, $this->password);
	}

	/**
	 * Генерируем хэш пароля
	 * @param string пароль
	 * @return string хэш
	 */
	public function hashPassword($password) {
		return CPasswordHelper::hashPassword($password);
	}
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return [
			'sorted' => ['order' => 't.id DESC'],
		];
	}

	public function beforeSave() {
		if (parent::beforeSave()) {
			$this->last_action = date('Y-m-d H:i:s', time());
			if (strlen($this->password) < 60) {
				$this->password = $this->hashPassword($this->password);
			}
			return true;
		}
		else
			return false;
	}

}
