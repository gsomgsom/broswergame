<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Cuprum&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
		<link rel="icon" type="image/png" href="/assets/img/favicon.png">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
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
		<script src="/assets/js/wysiwyg/ckeditor.js"></script>
		<script src="/assets/js/wysiwyg/adapters/jquery.js"></script>
		<script src="/assets/js/wysiwyg/ckfinder/ckfinder.js"></script>
		<script src="/assets/js/game.js"></script>
		<script src="/assets/js/admin.js"></script>
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
			<?= $content ?>
			<hr>
			<footer>
				<p class="text-right">&copy; Все права защищены <?=date('Y')?></p>
			</footer>
		</div>
	</body>
</html>