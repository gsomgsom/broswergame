<?php
class LoggedController extends CController {

	public $user;

	protected function beforeAction($action) {
		// не авторизованным юзерам следует авторизоваться
		if (Yii::app()->user->isGuest) {
			$this->redirect('/');
		}
		$this->user = User::model()->findByPk(Yii::app()->user->id);
		$this->user->player->save(); // чтобы видеть, кто онлайн
		$this->user->player->applyAuras(); // применяем ауры и заклятия

		return parent::beforeAction($action);
	}

}