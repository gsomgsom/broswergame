<h3>Поиск желудей</h3>
<span><img src="/assets/img/bg-forest.png" width="100%"></span>
<p><img src="/assets/img/nuts16.png" title="жёлуди"> <strong>Жёлуди</strong> не только полезны и питательны. Солидный лесной житель просто обязан иметь в запасе <img src="/assets/img/nuts16.png" title="жёлуди"> <strong>жёлуди</strong>.</p>
<p>Кроме того за них можно приобрести много чего важного и нужного.</p>
<?
	$searchTimer = $this->user->player->getStateCooldown('search');
	$searchValue = $this->user->player->getStateVal('search');
?>
<? if ($searchValue != null): ?>
	<p class="text-center">Вы внимательно осматриваете окрестности леса.<br>
	Осталось: 
		<img class="i-clock" src="/assets/img/clock16.png" title="таймер"> <span id="b-timer-search-location">00:00</span>
	</p>
	<p class="text-center">
		<a class="btn btn-warning" href="/location/search/cancel" role="button">Прервать поиск</a>
	</p>
	<script>
		bTimer('#b-timer-search-location',<?= $searchTimer ?>,'hm', true, false, 'Идёт подсчёт...', function(){});
	</script>
<? else: ?>
	<p class="text-center">
		<a class="btn btn-success" href="/location/search/fast" role="button"><img src="/assets/img/nuts16.png" title="жёлуди"> Простой поиск (<?= round(Yii::app()->params['location_search_fast'] / 60) ?> мин)</a>
		<a class="btn btn-success" href="/location/search/long" role="button"><img src="/assets/img/nuts16.png" title="жёлуди"> Долгий поиск (<?= round(Yii::app()->params['location_search_long'] / 60) ?> мин)</a>
	</p>
<? endif ?>
