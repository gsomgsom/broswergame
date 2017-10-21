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
					<a href="/home">
						<img src="/assets/img/logo.png" width="150">
					</a>
					<h4><?= Yii::app()->name ?> <sub title="альфа-тест" style="color: red;">&alpha;</sub></h4>
				</div>
				<div class="col-9">
					<div class="row">
						<div class="col-5 text-center">
							<p><small><strong><?= $this->user->player->nickname ?></strong></small></p>
						</div>
						<div class="col-2 text-center">
							<img src="/assets/img/avsm-boy01.png" class="border rounded-circle" style="margin-top: -6px; background-color: #ccc;">
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
									<img src="/assets/img/hp16.png" title="здоровье"> <strong>100%</strong>
								</div>
							</div>
						</div>
						<div class="col-2 text-center" style="margin-top: -3px;">
							<span class="badge badge-dark" style="width: 100%;"><img src="/assets/img/lvl16.png" title="уровень"> <strong><?= $this->user->player->lvl ?></strong></span>
						</div>
						<div class="col-5 text-center">
							<div class="progress">
								<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 100%; height: 22px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
									<img src="/assets/img/energy16.png" title="энергия"> <strong>100%</strong>
								</div>
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
					<h4>Локации</h4>
					<div>
						<a href="/home">Домой</a><br>
						<a href="/mail">Почта</a><br>
						<a href="/chat">Чат</a><br>
						<a href="/battles">Сражения</a><br>
						<a href="/shop">Магазин</a>
					</div>
				</div>
				<div class="col-12 col-md-9">
					<div class="row">
						<div class="col-12">
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
		<script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="/assets/js/game.js"></script>
	</body>
</html>