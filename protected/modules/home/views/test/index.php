<h3>Тут вершится история</h3>
<div class="row">
	<div class="col-md-12">
<?
for ($l=1; $l<=50; $l++) {
echo $l.' - '.Formulas::getPlayerExpByLevel($l).'<br>';
}
?>
	</div>
</div>