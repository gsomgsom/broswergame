<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Cuprum&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
		<link rel="icon" type="image/png" href="/assets/img/favicon.png">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" href="/assets/css/style.css">
		<title><? $this->widget('Title') ?></title>
		<script>
			var current_time = <?= time() ?>;
			var day_time = <?= time() - (date('H')*60*60 + date('i')*60 + date('s')); ?>;
			var server_day = 0;
		</script>
		<script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="/assets/js/game.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-md-center" id="topNav">
				<? $this->widget('MainMenu') ?>
			</div>
		</nav>
		<div class="main container">
			<div class="row">
				<div class="col-3 text-center">
					<a href="/player">
						<img src="/assets/img/logo.png" width="150">
					</a>
					<h4><?= Yii::app()->name ?> <sub title="альфа-тест" style="color: red;">&alpha;</sub></h4>
					<div class="small">Время на сервере:
						<strong><span class="server-time"><?= date('H:i:s') ?></span></strong>
					</div>
				</div>
				<div class="col-9">
					<div class="row">
						<div class="col-5 text-center">
							<p><small><strong><a href="/player/look/player/id/<?= $this->user->player->id ?>"><?= $this->user->player->nickname ?></a></strong></small></p>
						</div>
						<div class="col-2 text-center">
						<? if ($this->user->player->gender == Player::GENDER_MALE): ?>
							<img src="/assets/img/avsm-boy01.png" class="border rounded-circle" style="margin-top: -6px; background-color: #ccc;">
						<? else: ?>
							<img src="/assets/img/avsm-girl01.png" class="border rounded-circle" style="margin-top: -6px; background-color: #ccc;">
						<? endif ?>
						</div>
						<div class="col-5 text-center">
							<p>
								<small>
									Вы не состоите в гильдии<br>
									<a href="#">основать гильдию</a>
								</small>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-5 text-center">
							<div class="progress">
								<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%; height: 22px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
									&nbsp;
								</div>
							</div>
							<div class="progress-text">
								<img src="/assets/img/hp16.png" title="здоровье"> <strong>100%</strong>
							</div>
						</div>
						<div class="col-2 text-center" style="margin-top: -3px;">
							<span class="badge badge-dark" style="width: 100%;"><img src="/assets/img/lvl16.png" title="уровень"> <strong><?= $this->user->player->lvl ?></strong></span>
						</div>
						<div class="col-5 text-center">
							<div class="progress">
								<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: <?= ceil(($this->user->player->expAtLevel() / $this->user->player->expToLevelMax()) * 100) ?>%; height: 22px;" aria-valuenow="<?= $this->user->player->expAtLevel() ?>" aria-valuemin="0" aria-valuemax="<?= $this->user->player->expToLevelMax() ?>">
									&nbsp;
								</div>
							</div>
							<div class="progress-text">
								<img src="/assets/img/exp16.png" title="опыт"> <strong><?= $this->user->player->expAtLevel() ?> / <?= $this->user->player->expToLevelMax() ?></strong>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-4 col-md-6">
							<div class="row">
								<div class="col-4 text-center">
									<img src="/assets/img/coins64.png" title="монеты">
								</div>
								<div class="col-8">
									<p>Монеты:<br>
									<small><nobr><strong><?= $this->user->player->getCoinsText() ?></strong></nobr></small></p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="row">
								<div class="col-4 text-center">
									<img src="/assets/img/nuts64.png" title="жёлуди">
								</div>
								<div class="col-8">
									<p>Жёлуди:<br>
									<small><nobr><strong><?= $this->user->player->getNutsText() ?></strong></nobr></small></p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="row">
								<div class="col-4 text-center">
									<img src="/assets/img/mushrooms64.png" title="грибы">
								</div>
								<div class="col-8">
									<p>Грибы:<br>
									<small><nobr><strong><?= $this->user->player->getMushroomsText() ?></strong></nobr></small></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-12 col-md-3" id="sidebar">
					<? $this->widget('SidebarLeft') ?>
				</div>
				<div class="col-12 col-md-9">
					<div class="row">
						<div class="col-12">

							<? if(Yii::app()->user->hasFlash('success')): ?>
								<div id="alert-success" role="alert" class="alert alert-success alert-dismissible fade show">
									<?= Yii::app()->user->getFlash('success'); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<script>
							    	$('#alert-success').delay(4500).fadeOut();
								</script>
							<? endif ?>

							<? if(Yii::app()->user->hasFlash('error')): ?>
								<div id="alert-error" role="alert" class="alert alert-danger alert-dismissible fade show">
									<?= Yii::app()->user->getFlash('error'); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<script>
									$('#alert-error').delay(4500).fadeOut();
								</script>
							<? endif ?>

							<?= $content ?>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<footer>
				<p class="text-right">&copy; Все права защищены <?=date('Y')?></p>
			</footer>
		</div>
	</body>
</html>