<div><h3><?= $newsEntry->title ?></h3><span style="float: right;"><?= date('d.m.Y H:i', strtotime($newsEntry->dt)) ?></span></div>
<?= $newsEntry->content ?>