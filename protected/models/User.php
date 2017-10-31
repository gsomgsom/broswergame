<?php

/**
 * Модель "User"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Учётная запись игрока (пользователя). Данные для авторизации, роль.
 */

class User extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{users}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['password, email', 'required'],
			['password, email', 'length', 'max' => 128],
			['role', 'in', 'range' => ['player','moderator','admin'], 'message' => 'Указана неизвестная роль'],
			['role, forgot_hash, forgot_timeout, datereg, last_action', 'safe'],
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [
			'player' => [self::HAS_ONE, 'Player', ['user_id' => 'id']],
		];
	}

	/**
	 * Названия полей таблицы
	 * @return array
	 */
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
			'sorted' => ['order' => 't.id DESC'],
		];
	}

	/**
	 * Действие перед сохранением в БД
	 * @return bool
	 */
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
