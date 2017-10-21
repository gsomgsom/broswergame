<div class="row">
	<div>
		<h4>Локации</h4>
		<a href="/home" class="<? if (get_class($this->controller->module) == 'HomeModule'): ?>active<? endif ?>">Домой</a><br>
		<a href="/mail" class="<? if (get_class($this->controller->module) == 'MailModule'): ?>active<? endif ?>">Почта</a><br>
		<a href="/chat" class="<? if (get_class($this->controller->module) == 'ChatModule'): ?>active<? endif ?>">Чат</a><br>
		<a href="/battles" class="<? if (get_class($this->controller->module) == 'BattlesModule'): ?>active<? endif ?>">Сражения</a><br>
		<a href="/shop" class="<? if (get_class($this->controller->module) == 'ShopModule'): ?>active<? endif ?>">Магазин</a>
	</div>
</div>
<hr>
<div class="row">
	<h4>Журнал</h4>
	<? $this->widget('LastLog') ?>
</div>
