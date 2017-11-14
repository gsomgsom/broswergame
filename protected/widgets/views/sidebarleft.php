<div class="row">
	<div class="col-12">
		<h4>Локации</h4>
		<a href="/player" class="<? if (get_class($this->controller->module) == 'PlayerModule'): ?>active<? endif ?>">Рюкзак</a><br>
		<a href="/location/scout" class="<? if (get_class($this->controller->module) == 'LocationModule'): ?>active<? endif ?>">Разведка</a><br>
		<a href="/location/search" class="<? if (get_class($this->controller->module) == 'LocationModule'): ?>active<? endif ?>">Поиск желудей</a><br>
		<a href="/mail" class="<? if (get_class($this->controller->module) == 'MailModule'): ?>active<? endif ?>">Почта</a><br>
		<a href="/chat" class="<? if (get_class($this->controller->module) == 'ChatModule'): ?>active<? endif ?>">Чат</a><br>
		<a href="/world/battle" class="<? if (get_class($this->controller->module) == 'WorldModule'): ?>active<? endif ?>">Сражения</a><br>
		<a href="/location/shop" class="<? if (get_class($this->controller->module) == 'LocationModule'): ?>active<? endif ?>">Магазин</a><br>
		<a href="/location/wheel" class="<? if (get_class($this->controller->module) == 'LocationModule'): ?>active<? endif ?>">Колесо фортуны</a><br>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-12">
		<h4>Таймеры</h4>
		<? $this->widget('PlayerTimers') ?>
	</div>
	<div class="col-12">
		<h4>Эффекты</h4>
		<? $this->widget('PlayerEffects') ?>
	</div>
	<div class="col-12">
		<h4>Журнал</h4>
		<? $this->widget('LastLog') ?>
	</div>
</div>
