<h3>Тут вершится история</h3>
<div class="row">
	<div class="col-md-12">
<?
$playerAtt = Player::model()->findByPk(1);
$damageAtt = 0;
$playerDef = Player::model()->findByPk(2);
$damageDef = 0;

for($n=1; $n<=10; $n++) {
	$logStr = '';

	echo "<b>Раунд ".$n."</b><br>\n";

	$turnAtt = Formulas::countBattleTurn($playerAtt, $playerDef);
	$logStr .= $turnAtt['log'];
	$damageAtt += $turnAtt['damage'];

	$turnDef = Formulas::countBattleTurn($playerDef, $playerAtt);
	$logStr .= $turnDef['log'];
	$damageDef += $turnDef['damage'];

	echo $logStr;

	echo "<br>\n";
}

echo "<hr>\n";

echo "Счёт: {$damageAtt} : {$damageDef}<br>\n";
if ($damageAtt > $damageDef) {
	echo "Победил: <b>".$playerAtt->nickname."</b><br>\n";
}
elseif ($damageAtt < $damageDef) {
	echo "Победил: <b>".$playerDef->nickname."</b><br>\n";
}
else {
	echo "<b>Ничья</b><br>\n";
}

?>
	</div>
</div>