<h3>Новости</h3>
<? foreach ($news as $newsEntry): ?>
<p>
	<span><?= date('d.m.Y H:i', strtotime($newsEntry->dt)) ?></span>
	<a href="/news/read/entry/id/<?= $newsEntry->id ?>"><?= $newsEntry->title ?></a>
</p>
<? endforeach ?>