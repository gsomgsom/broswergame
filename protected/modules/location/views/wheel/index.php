<h3>Колесо фортуны</h3>
<div class="text-center" style="position: relative;">
<img src="/assets/img/wheel.svg" width="500" />
<?
	$coords = [
		[
			'top' => 50,
			'left' => 380,
		],
		[
			'top' => 100,
			'left' => 504,
		],
		[
			'top' => 224,
			'left' => 554,
		],
		[
			'top' => 350,
			'left' => 504,
		],
		[
			'top' => 395,
			'left' => 380,
		],
		[
			'top' => 350,
			'left' => 258,
		],
		[
			'top' => 224,
			'left' => 209,
		],
		[
			'top' => 100,
			'left' => 258,
		],
	];
	for($i=0; $i<=7; $i++):
		$this->widget('WheelItem', ['id' => $wheel[$i]['id'], 'amount' => $wheel[$i]['amount'], 'top' => $coords[$i]['top'], 'left' => $coords[$i]['left']]);
	endfor;
?>
</div>

<? if ($this->user->player->nuts < Yii::app()->params['location_wheel']): ?>
	<? $diff = Yii::app()->params['location_wheel'] - $this->user->player->nuts; ?>
	<p class="text-center">Не хватает <strong><?= $diff ?> <img src="/assets/img/nuts16.png" title="жёлуди"> <?= Funcs::declination($diff,'жёлудь','жёлудя','желудей') ?>.</strong><br>
	Заходите, как разбогатеете.
<? else: ?>
	<p class="text-center">Судьба ждёт своего счастливца!<br>
	Всего <strong><?= Yii::app()->params['location_wheel'] ?> <img src="/assets/img/nuts16.png" title="жёлуди"> <?= Funcs::declination(Yii::app()->params['location_wheel'],'жёлудь','жёлудя','желудей') ?>.</strong>
	<p class="text-center">
		<a class="btn btn-success" href="/location/wheel/roll" role="button">Мне повезёт!</a>
	</p>
<? endif ?>
