<h1 style="text-align: center; color: #fff; font-size: 2.2em; text-shadow: 2px 2px #000;">Усердный труд скоро принесёт свои плоды!</h1>
<div class="login-box card" style="z-index: 5; margin-top: 2em;">
	<div class="card-body">
		<? if ($sent): ?>
			<div class="alert alert-success" role="alert">
			Спасибо за проявленный интерес!<br>
			Как только, так сразу!
			</div>
		<? endif ?>
		<? $form = $this->beginWidget('CActiveForm', [
			'id' => 'signin-form',
			'action' => '/',
			'enableAjaxValidation' => true,
			'htmlOptions' => ['role' => 'form', 'class' => 'form-horizontal form-material'],
		]); ?>
		<h3 class="box-title m-b-20">Хочу узнать всё первым</h3>
		<div class="form-group ">
			<div class="col-xs-12">
				<?= $form->error($model, 'email'); ?>
				<?= $form->textField($model, 'email', ['class' => 'form-control', 'placeholder' => 'user@mail']); ?>
			</div>
		</div>
		<div class="form-group text-center m-t-20">
			<div class="col-xs-12">
				<button class="btn btn-success btn-lg btn-block text-uppercase" type="submit">Держите меня в курсе!</button>
			</div>
		</div>
		<? $this->endWidget(); ?>
	</div>
</div>
