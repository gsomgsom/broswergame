<h3>Журнал</h3>
<ul class="nav nav-tabs log-tab">
	<li class="nav-item">
		<a class="nav-link <? if ($logTypeID == 0): ?>active<? endif ?>" href="/mail/log/">Всё</a>
	</li>
	<? foreach ($logTypes as $logType): ?>
		<li class="nav-item">
			<a class="nav-link <? if ($logTypeID == $logType->id): ?>active<? endif ?>" href="/mail/log/index/type/<?= $logType->alias ?>"><?= $logType->title ?></a>
		</li>
	<? endforeach ?>
</ul>
<? foreach ($log as $logEntry): ?>
<p><span class="text-info"><?= date('d.m.Y H:i', strtotime($logEntry->dt)) ?></span> <?= $logEntry->html ?></p>
<? endforeach ?>
