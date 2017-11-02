<ul class="navbar-nav top-nav">
	<li class="nav-item <? if (get_class($this->controller->module) == 'NewsModule'): ?>active<? endif ?>">
		<a class="nav-link" href="/news">Новости</span></a>
	</li>
	<li class="nav-item <? if (get_class($this->controller->module) == 'ForumModule'): ?>active<? endif ?>">
		<a class="nav-link" href="/forum">Форум</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/home/usersettings">Аккаунт</a>
	</li>
	<li class="nav-item">
		<a class="nav-link disabled" href="#">Поддержка</a>
	</li>
	<? if ($this->getController()->user->role == 'admin'): ?>
		<li class="nav-item <? if (get_class($this->controller->module) == 'AdminModule'): ?>active<? endif ?>">
			<a class="nav-link" href="/admin">Админ-панель</a>
		</li>
	<? endif ?>
	<li class="nav-item">
		<a class="nav-link" href="/auth/login/logout">Выйти</a>
	</li>
</ul>
