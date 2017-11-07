<div id="drop-window">
<div class="drop-window" id="reswindows" style="display: none;">
	<div class="drop-img reswindow <?= $class ?>"></div>
	<div class="drop-body reswindow">
		<div class="reswindow-source">
			<div class="text">
				<?= $text ?>
        	</div>
        	<div class="reses">
				<? if (isset($drop['coins'])): ?>
	                <div class="item inline"><b class="g55_icons i55_coin" title="монеты"></b><div class="count"><?= $drop['coins']?></div></div>
				<? endif ?>
				<? if (isset($drop['nuts'])): ?>
					<div class="item inline"><b class="g55_icons i55_cone" title="шишки"></b><div class="count"><?= $drop['nuts']?></div></div>
				<? endif ?>
				<? foreach ($drop['items'] as $drop_item): ?>
					<? $item = Item::model()->findByPk($drop_item['id']); ?>
					<div class="item inline"><b class="g55_icons <?= $item->class ?>-<?= $item->id ?>" title="<?= $item->name ?>"></b><div class="count"><?= $drop_item['amount'] ?></div></div>
				<? endforeach ?>
			</div>
			<div style="text-align: center; margin-bottom: 16px;"></div>
		</div>
	</div>
</div>
	<script>
		$(document).ready(function(){
			$("#reswindows").dialog({
				resizable: false,
				modal: true,
				draggable: false,
				width: 520,
				title: '<?= $title ?>'
			});
		});
	</script>
