<? foreach ($log as $logEntry): ?>
<p><span class="text-info"><?= date('d.m.Y H:i', strtotime($logEntry->dt)) ?></span> <?= $logEntry->html ?></p>
<? endforeach ?>
<p><a href="/mail/log" class="btn btn-small btn-info">Весь журнал</a></p>
