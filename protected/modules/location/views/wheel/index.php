<h3>Колесо фортуны</h3>
<p class="text-center">
<img src="/assets/img/wheel.svg" width="500">
<?
	$coords = [
		[
			'top' => 90,
			'left' => 394,
		],
		[
			'top' => 140,
			'left' => 518,
		],
		[
			'top' => 264,
			'left' => 568,
		],
		[
			'top' => 390,
			'left' => 518,
		],
		[
			'top' => 435,
			'left' => 394,
		],
		[
			'top' => 390,
			'left' => 272,
		],
		[
			'top' => 264,
			'left' => 223,
		],
		[
			'top' => 140,
			'left' => 272,
		],
	];
	for($i=0; $i<=7; $i++):
		$this->widget('WheelItem', ['id' => $wheel[$i]['id'], 'amount' => $wheel[$i]['amount'], 'top' => $coords[$i]['top'], 'left' => $coords[$i]['left']]);
	endfor;
?>
</p>

<? if ($this->user->player->nuts < Yii::app()->params['location_wheel']): ?>
	<? $diff = Yii::app()->params['location_wheel'] - $this->user->player->nuts; ?>
	<p class="text-center">Не хватает <strong><?= $diff ?><img src="/assets/img/nuts16.png" title="жёлуди"> желудей.</strong><br>
	Заходите, как разбогатеете.
<? else: ?>
	<p class="text-center">Судьба ждёт своего счастливца!<br>
	Всего <strong><?= Yii::app()->params['location_wheel'] ?> <img src="/assets/img/nuts16.png" title="жёлуди"> желудей.</strong>
	<p class="text-center">
		<a class="btn btn-success" href="/location/wheel/roll" role="button">Мне повезёт!</a>
	</p>
<? endif ?>
