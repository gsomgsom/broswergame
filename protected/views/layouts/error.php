<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Ошибка!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='https://fonts.googleapis.com/css?family=Cuprum:400,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<style>
			html {
				height: 100%;
				min-width: 100%;
				margin: 0;
				padding: 0;
			}
			body {
				overflow: hidden;
				position: relative;
				height: 100%;
				margin: 0;
				padding: 0;
				background: #314a20 url(/assets/img/login-bg.jpg) repeat-x;
				color: #fff;
				font-size: 16px;
				line-height: 1.2;
				font-family: 'Cuprum', sans-serif;
			}
			.container {
				position: absolute;
				top: 50%;
				left: 50%;
				width: 600px;
				height: 500px;
				margin-left: -300px;
				margin-top: -250px;
				text-align: center;
			}
			h1 {
				color: #fff;
				font-size: 5rem;
				text-shadow: #132 2px 2px;
			}
			p {
				font-size: 1.5rem;
				font-weight: 300;
				line-height: 1.8;
				margin: 2em 0;
			}
			p.txt {
				margin: 2rem;
				text-shadow: #132 2px 2px;
			}
			a {
				text-decoration: underline;
				color: #bd8;
			}
			a:focus,
			a:hover {
				text-decoration: none;
				outline: none;
			}
			@media (max-width: 600px) {
				.container {
					position: static;
					top: 0;
					left: 0;
					width: auto;
					height: auto;
					margin-left: 10px;
					margin-right: 10px;
					margin-top: 50px;
					text-align: center;
					font-size: 62.5%;
				}
				h1 {
					margin-top: 0;
				}
			}
		</style>
	</head>
	<body>
		<div class="container">
			<?= $content ?>
		</div>
	</body>
</html>