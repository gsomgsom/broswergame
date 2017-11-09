<?php
class LoggedController extends CController {

	public $user;

	protected function beforeAction($action) {
		// не авторизованным юзерам следует авторизоваться
		if (Yii::app()->user->isGuest) {
			$this->redirect('/');
		}
		$this->user = User::model()->findByPk(Yii::app()->user->id);
		$this->user->save(); // чтобы видеть, кто онлайн

		// Применяем ауры и заклятия
		foreach ($this->user->player->states as $player_state) {
			if ($player_state->state_text == 'aura') {
				$aura_class = new $player_state->alias;
				$aura_class->auraEffect();
			}
			if (($player_state->state_text == 'spell') && (strtotime($player_state->cooldown) > time())) {
				$aura_class = new $player_state->alias;
				$aura_class->auraEffect();
			}
		}

		return parent::beforeAction($action);
	}

}