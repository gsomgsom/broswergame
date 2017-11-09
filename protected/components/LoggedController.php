<?php
class LoggedController extends CController {

	public $user;

	/**
	 * @var string Сообщение (success / error / ещё что-нибудь)
	 */
	public $message = '';

	protected function beforeAction($action) {
		// не авторизованным юзерам следует авторизоваться
		if (Yii::app()->user->isGuest) {
			$this->redirect('/');
		}
		$this->user = User::model()->findByPk(Yii::app()->user->id);
		$this->user->save(); // чтобы видеть, кто онлайн

		return parent::beforeAction($action);
	}

}