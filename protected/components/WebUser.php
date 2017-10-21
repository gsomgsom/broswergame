<?php

class WebUser extends CWebUser {
	public $loginUrl=['/auth/login'];
	private $_model = null;

	public function getRole() {
		return 'user';
	}

	private function getModel() {
		if (!$this->isGuest && $this->_model === null) {
			$this->_model = User::model()->findByPk($this->id, ['select' => 'role']);
		}
		return $this->_model;
	}

}
