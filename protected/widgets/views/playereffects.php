<? if (sizeof($effects)): ?>
	<ul>
	<? foreach ($effects as $effect): ?>
		<li><?= $effect['name'] ?></li>
	<? endforeach ?>
	</ul>
<? else: ?>
	<p>Нет активных эффектов</p>
<? endif ?>
