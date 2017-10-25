<? foreach ($timers as $timer): ?>
	<p><?= $timer['title'] ?>: 
		<img class="i-clock" src="/assets/img/clock16.png" title="таймер"> <span id="b-timer-<?= $timer['alias'] ?>">00:00</span>
	</p>
	<script>
		bTimer('#b-timer-<?= $timer['alias'] ?>',<?= $timer['cooldown'] ?>,'hm', 'none', false, 'Не активно', function(){});
	</script>
<? endforeach ?>