<h3>Разведка</h3>
<span><img src="/assets/img/bg-forest.png" width="100%"></span>
<?
	$scoutsLeft = $this->user->player->getStateIntVal('scouts_left');
	$scoutTimer = $this->user->player->getStateCooldown('scout');
	$scoutValue = $this->user->player->getStateVal('scout');
?>
<p>Если хорошо разведать окрестности леса, то можно найти немного <img src="/assets/img/coins16.png" title="монеты"> <strong>монет</strong>, а если повезёт, то и самый настоящий <strong>клад</strong>.</p>
<? if ($scoutValue != null): ?>
	<p class="text-center">Вы внимательно осматриваете окрестности леса.<br>
	Осталось: 
		<img class="i-clock" src="/assets/img/clock16.png" title="таймер"> <span id="b-timer-scout-location">00:00</span>
	</p>
	<p class="text-center">
		<a class="btn btn-warning" href="/location/scout/cancel" role="button">Прервать разведку</a>
	</p>
	<script>
		bTimer('#b-timer-scout-location',<?= $scoutTimer ?>,'hm', true, false, 'Идёт подсчёт...', function(){});
	</script>
<? elseif (!$scoutsLeft): ?>
	<p class="text-center">Хватит на сегодня.</p>
<? else: ?>
	<p>На сегодня осталось <img class="i-clock" src="/assets/img/clock16.png" title="таймер"> <strong><?= $scoutsLeft ?></strong> минут в развдеке.</p>
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<div class="text-center">
				<select class="form-control form-control form-control-sm" id="scout_minutes_select">
				<? for ($i=10; $i<=$scoutsLeft; $i+=10): ?>
					<option value="<?=$i * 60?>"><?=$i?> минут</option>
				<? endfor ?>
				</select>
				<a class="btn btn-success js--scout-go-btn" href="/location/scout/go" role="button">Отправиться в разведку</a>
			</div>
		</div>
	</div>
<? endif ?>

<script>
$(document).ready(function() {
	$('#scout_minutes_select').change(function(){
		$('.js--scout-go-btn').attr('href', '/location/scout/go/time/' + $(this).val());
	});
});
</script>