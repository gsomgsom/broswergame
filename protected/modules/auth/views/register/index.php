			<div class="row">
				<div class="col-12 text-center">
					<img src="/assets/img/logo.png">
					<h1><?= Yii::app()->name ?> <sub title="альфа-тест" style="color: red;">&alpha;</sub></h1>
					<p style="color: #fff; text-shadow: #132 1px 1px;">Создания тьмы против народа света. Кто победит? Решать вам!</p>
				</div>
			</div>
			<div class="login-box card">
				<? $form = $this->beginWidget('CActiveForm', [
					'id' => 'register-form',
					'action' => '/auth/register',
					'enableAjaxValidation' => true,
					'htmlOptions' => ['role' => 'form'],
				]); ?>
				<div class="card-body">
					<h3 class="box-title m-b-20">Регистрация в игре</h3>
					<div class="form-group">
						<div class="col-xs-12">
							<?= $form->error($modelUser, 'email'); ?>
							<?= $form->textField($modelUser, 'email', ['class' => 'form-control', 'placeholder' => 'E-mail']); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<?= $form->error($modelUser, 'password'); ?>
							<?= $form->passwordField($modelUser, 'password', ['class' => 'form-control',  'placeholder' => 'Пароль']); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<?= $form->error($modelUser, 'password_again'); ?>
							<?= $form->passwordField($modelUser, 'password_again', ['class' => 'form-control',  'placeholder' => 'Пароль (ещё раз)']); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<?= $form->error($modelPlayer, 'nickname'); ?>
							<?= $form->textField($modelPlayer, 'nickname', ['class' => 'form-control', 'placeholder' => 'Ник в игре']); ?>
						</div>
					</div>
					<? if ($modelUser->scenario == 'invite'): ?>
						<div class="form-group">
							<div class="col-xs-12">
								<?= $form->error($modelUser, 'invite'); ?>
								<?= $form->textField($modelUser, 'invite', ['class' => 'form-control', 'placeholder' => 'Код приглашения']); ?>
							</div>
						</div>
					<? endif ?>
					<div class="form-group">
						<div class="col-md-12">
							<?= $form->label($modelUser, 'Пол персонажа: ', ['for' => 'UserForm_gender']); ?>
							<?= $form->radioButtonList($modelPlayer, 'gender', ['1'=>'Мужской', '0'=>'Женский'], ['separator'=>' ']); ?>
							<?= $form->error($modelUser, 'licenseAccepted'); ?><br>
							<?= $form->checkBox($modelUser, 'licenseAccepted'); ?>
							<?= $form->label($modelUser, 'Подтверждаю согласие с правилами', ['for' => 'UserForm_licenseAccepted']); ?>
						</div>
					</div>
					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button class="btn btn-success btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Зарегистрироваться</button>
						</div>
					</div>
					<div class="form-group m-b-0">
						<div class="col-sm-12 text-center">
							<p>Уже регистрировались? <a href="/auth/login" class="text-info m-l-5"><b>Войти</b></a></p>
						</div>
					</div>
				<? $this->endWidget(); ?>
				</div>
			</div>
