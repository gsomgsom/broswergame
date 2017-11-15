<h3>Админ-панель</h3>
<div class="row">
	<div class="col-md-12">
		<div class="card-deck">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Новости</h4>
					<p class="card-text">
						Управление новостями. Их публикация, редактирование и распубликация.<br><br>
					</p>
					<div class="text-right">
						<a href="/admin/news" class="btn btn-info">Список</a>
					</div>
				</div>
				<div class="card-footer">
					<? $news_count = News::model()->count(); ?>
					<small class="text-muted">
						Всего <strong><?= $news_count ?></strong> <?= Funcs::declination($news_count,'новость','новости','новостей') ?>
					</small>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Игроки</h4>
					<p class="card-text">
						Управление игроками, наказаниями, их журнал, отладочные сообщения, содержимое рюкзака, ауры и т.д.
					</p>
					<div class="text-right">
						<a href="/admin/players" class="btn btn-info disabled" disabled="disabled">Список</a>
					</div>
				</div>
				<div class="card-footer">
					<? $user_count = User::model()->count(); ?>
					<small class="text-muted">
						Зарегистрировано <strong><?= $user_count ?></strong> <?= Funcs::declination($user_count,'игрок','игрока','игроков') ?>
					</small>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Предметы</h4>
					<p class="card-text">
						Управление шаблонами предметов. Создание и редактирование шаблонов предметов. Обновление предметов у игроков.
					</p>
					<div class="text-right">
						<a href="/admin/items" class="btn btn-info">Список</a>
					</div>
				</div>
				<div class="card-footer">
					<? $item_count = Item::model()->count(); ?>
					<small class="text-muted">
						Всего <strong><?= $item_count ?></strong> <?= Funcs::declination($item_count,'предмет','предмета','предметов') ?>
					</small>
				</div>
			</div>
		</div>
	</div>
</div>
