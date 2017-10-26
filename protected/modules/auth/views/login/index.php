			<div class="row">
				<div class="col-12 text-center">
					<img src="/assets/img/logo.png">
					<h1><?= Yii::app()->name ?> <sub title="альфа-тест" style="color: red;">&alpha;</sub></h1>
					<p style="color: #fff; text-shadow: #132 1px 1px;">Создания тьмы против народа света. Кто победит? Решать вам!</p>
				</div>
			</div>
			<div class="login-box card">
				<? $form = $this->beginWidget('CActiveForm', [
					'id' => 'login-form',
					'action' => '/auth/login',
					'enableAjaxValidation' => true,
					'htmlOptions' => ['role' => 'form'],
				]); ?>
				<div class="card-body">
					<form class="form-horizontal form-material" id="loginform" action="index.html">
						<h3 class="box-title m-b-20">Вход в игру</h3>
						<div class="form-group ">
							<div class="col-xs-12">
								<?= $form->error($model, 'email'); ?>
								<?= $form->textField($model, 'email', ['class' => 'form-control', 'placeholder' => 'E-mail']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<?= $form->error($model, 'password'); ?>
								<?= $form->passwordField($model, 'password', ['class' => 'form-control',  'placeholder' => 'Пароль']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="checkbox checkbox-primary pull-left p-t-0">
									<?= $form->checkBox($model, 'rememberMe'); ?>
									<?= $form->label($model, 'Запомнить', ['for' => 'LoginForm_rememberMe']); ?>
								</div>
							</div>
						</div>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<button class="btn btn-success btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Войти</button>
							</div>
						</div>
						<div class="form-group m-b-0">
							<div class="col-sm-12 text-center">
								<p>Не прописаны в городе? <a href="/auth/register" class="text-info m-l-5"><b>Пройти регистрацию</b></a></p>
							</div>
						</div>
					</form>
				<? $this->endWidget(); ?>
				</div>
			</div>
