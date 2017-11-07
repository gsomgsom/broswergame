<h3>Аккаунт</h3>
<div class="row">
	<div class="col-md-12">
		<div id="alert-error" role="alert" class="alert alert-warning alert-dismissible fade show">
			<h4 class="alert-heading">Будьте внимательны!</h4>
			<p>Администрации игры <strong>никогда</strong> и ни при каких обстоятельствах <strong>не требуется</strong> ваш <strong>пароль</strong>.</p>
		</div>
		<div class="card border-light mb-3">
			<div class="card-header">Смена электронной почты</div>
			<? $form = $this->beginWidget('CActiveForm', [
				'id' => 'account-email-form',
				'action' => '/player/usersettings',
				'enableAjaxValidation' => true,
				'htmlOptions' => ['role' => 'form'],
			]); ?>
				<div class="card-body">
					<p class="card-text">Ваш текущий адрес электронной почты, к которому привязан персонаж: <strong><?= $this->user->email ?></strong></p>
					<p class="card-text">
						<?= $form->error($model, 'email'); ?>
						<?= $form->textField($model, 'email', ['class' => 'form-control', 'placeholder' => 'E-mail']); ?>
					</p>
					<p class="card-text text-center">
						<button class="btn btn-default btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Сохранить новый e-mail</button>
					</p>
				</div>
			<? $this->endWidget(); ?>
		</div>
		<div class="card border-light mb-3">
			<div class="card-header">Смена пароля</div>
				<div class="card-body">
					<div class="form-group">
						<label for="oldpass">Старый пароль:</label>
						<input name="oldpass" id="oldpass" class="form-control" value="" type="passwoed">
					</div>
					<div class="form-group">
						<label for="oldpass">Новый пароль:</label>
						<input name="oldpass" id="oldpass" class="form-control" value="" type="passwoed">
					</div>
					<div class="form-group">
						<label for="oldpass">Новый пароль ещё раз:</label>
						<input name="oldpass" id="oldpass" class="form-control" value="" type="passwoed">
					</div>
					<p class="card-text text-center">
						<button class="btn btn-default btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Поменять пароль</button>
					</p>
				</div>
		</div>
		<div class="card text-white bg-dark mb-3">
			<div class="card-header">Удалить персонажа</div>
				<div class="card-body">
					<p class="card-text">Надоело играть? Решили начать заново?</p>
					<p class="card-text text-center">
						<button class="btn btn-secondary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Удалить персонажа</button>
					</p>
				</div>
		</div>
	</div>
</div>