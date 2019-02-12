<h3>Лог боя</h3>
<div class="row">
	<div class="col-md-6">
		<div style="text-align: center;"><b><?= $attacker->nickname ?> </b></div>
		<div style="width: 100%; color: #c00;"><img src="/assets/img/str16.png" title="сила"> Сила: <span style="position: absolute; right: 4rem;"><b><?= $attacker->countStr() ?> </b></span></div>
		<div style="width: 100%; color: #444;"><img src="/assets/img/def16.png" title="защита"> Защита: <span style="position: absolute; right: 4rem;"><b><?= $attacker->countDef() ?> </b></span></div>
		<div style="width: 100%; color: #00c;"><img src="/assets/img/agi16.png" title="ловкость"> Ловкость: <span style="position: absolute; right: 4rem;"><b><?= $attacker->countDex() ?> </b></span></div>
		<div style="width: 100%; color: #0c0;"><img src="/assets/img/vit16.png" title="стойкость"> Стойкость: <span style="position: absolute; right: 4rem;"><b><?= $attacker->countSta() ?> </b></span></div>
		<div style="width: 100%; color: #404;"><img src="/assets/img/int16.png" title="интеллект"> Интеллект: <span style="position: absolute; right: 4rem;"><b><?= $attacker->countInt() ?> </b></span></div>
	</div>
	<div class="col-md-6">
		<div style="text-align: center;"><b><?= $defender->nickname ?> </b></div>
		<div style="width: 100%; color: #c00;"><img src="/assets/img/str16.png" title="сила"> Сила: <span style="position: absolute; right: 4rem;"><b><?= $defender->countStr() ?> </b></span></div>
		<div style="width: 100%; color: #444;"><img src="/assets/img/def16.png" title="защита"> Защита: <span style="position: absolute; right: 4rem;"><b><?= $defender->countDef() ?> </b></span></div>
		<div style="width: 100%; color: #00c;"><img src="/assets/img/agi16.png" title="ловкость"> Ловкость: <span style="position: absolute; right: 4rem;"><b><?= $defender->countDex() ?> </b></span></div>
		<div style="width: 100%; color: #0c0;"><img src="/assets/img/vit16.png" title="стойкость"> Стойкость: <span style="position: absolute; right: 4rem;"><b><?= $defender->countSta() ?> </b></span></div>
		<div style="width: 100%; color: #404;"><img src="/assets/img/int16.png" title="интеллект"> Интеллект: <span style="position: absolute; right: 4rem;"><b><?= $defender->countInt() ?> </b></span></div>
	</div>
</div>
<hr>
<?= $html ?>
<hr>
<a href="/world/battle" class="btn btn-small btn-info">Назад</a>