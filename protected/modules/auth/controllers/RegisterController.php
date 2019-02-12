<?php

/**
 * Контроллер "RegisterController"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Регистрация в игре
 */

class RegisterController extends CController
{

	/**
	 * Форма регистрации
	 */
	public function actionIndex() {
		if (!Yii::app()->user->isGuest)
			$this->redirect('/player');

		$this->layout = 'guest';
		Yii::app()->params['pageTitle'] = 'Регистрация';

		// У нас две формы
		$modelUser = new UserForm;
		$modelUser->scenario = 'invite'; // регистрация только по приглашениям
		$modelPlayer = new PlayerForm;

		// Валидность форм
		$userFormValidated = false;
		$playerFormValidated = false;

		// AJAX запрос валидации?
		if (isset($_POST['ajax'])) {
			if ($_POST['ajax'] === 'user-form') {
				echo CActiveForm::validate($modelUser);
				Yii::app()->end();
			}
			elseif ($_POST['ajax'] === 'player-form') {
				echo CActiveForm::validate($modelPlayer);
				Yii::app()->end();
			}
		}

		if (isset($_POST['UserForm'])) {
			$modelUser->attributes=$_POST['UserForm'];
			if ($modelUser->validate()) {
				$userFormValidated = true;
			}
		}
		if (isset($_POST['PlayerForm'])) {
			$modelPlayer->attributes=$_POST['PlayerForm'];
			if ($modelPlayer->validate()) {
				$playerFormValidated = true;
			}
		}

		// Если обе формы успешно провалидированы, записывам новобранца
		if ($userFormValidated && $playerFormValidated) {
			$user = new User;
			$user->datereg = date("Y-m-d h:i:s", time());
			$user->email = $modelUser->email;
			$user->password = $modelUser->password;
			$resultUserSave = $user->save();
			if ($resultUserSave) {
				$player = new Player;
				$player->user_id = $user->id;
				$player->nickname = $modelPlayer->nickname;
				$player->gender = $modelPlayer->gender;
				$resultPlayerSave = $player->save();
				if ($resultPlayerSave) {
					// Ништяки за регистрацию
					$player->addItem(1, 1000);
					$player->coins += 1000;

					// Шлём письмо
					MailMan::send(
						$user->email,
						'Регистрация в тесте игры',
						"Вы зарегистрировались на тест игры.<br>\n<br>\nВаши учётные данные:<br>\n<br>\nE-mail: {$modelUser->email}<br>\nПароль: {$modelUser->password}",
						'smtp'
					);

					// Авторизуемся
					$login = new LoginForm;
					$login->email = $modelUser->email;
					$login->password = $modelUser->password;

					if ($login->validate() && $login->login())
						$this->redirect('/');
				}
				else {
					// @TODO - сообщаем об ошибке при регистрации игрока (а так точно бывает?)
					$user->delete();
					$this->redirect('/');
				}
			}
			else {
				// @TODO - сообщаем об ошибке при регистрации учётной записи (а так бывает?)
				$this->redirect('/');
			}
		}

		$this->render('index', [
			'modelUser' => $modelUser,
			'modelPlayer' => $modelPlayer
		]);
	}

}