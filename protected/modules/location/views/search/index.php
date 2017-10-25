<h3>Поиск желудей</h3>
<span><img src="/assets/img/bg-forest.png" width="100%"></span>
<p><img src="/assets/img/nuts16.png" title="жёлуди"> <strong>Жёлуди</strong> не только полезны и питательны. Солидный лесной житель просто обязан иметь в запасе <img src="/assets/img/nuts16.png" title="жёлуди"> <strong>жёлуди</strong>.</p>
<p>Кроме того за них можно приобрести много чего важного и нужного.</p>
<? $searchTimer = $this->user->player->getStateCooldown('search'); ?>
<? if ($searchTimer > time()): ?>
	<p class="text-center">
		<p>Вы внимательно осматриваете окрестности леса. Осталось: 
			<img class="i-clock" src="/assets/img/clock16.png" title="таймер"> <span id="b-timer-search-location">00:00</span>
		</p>
		<script>
			bTimer('#b-timer-search-location',<?= $searchTimer ?>,'dhm','none', false, 'Не активно', function(){});
		</script>
		<a class="btn btn-primary" href="/location/search/cancel" role="button">Прервать поиск</a>
	</p>
<? else: ?>
	<p class="text-center">
		<a class="btn btn-primary" href="/location/search/fast" role="button"><img src="/assets/img/nuts16.png" title="жёлуди"> Простой поиск (10 минут)</a>
		<a class="btn btn-primary" href="/location/search/long" role="button"><img src="/assets/img/nuts16.png" title="жёлуди"> Долгий поиск (60 минут)</a>
	</p>
<? endif ?>
