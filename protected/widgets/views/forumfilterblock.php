<div class="forum-title">
    <h3>Форум</h3>
</div>
<div class="filters-block">
    <ul class="forum-filters-menu">
        <li class="forum-filters-menu__item"><strong>Вернуться</strong> к <a href="#">разделам</a> форума</li>
        <li class="forum-filters-menu__item"><strong>Показать</strong> <a href="#">новые</a> сообщения</li>
        <li class="forum-filters-menu__item"><strong>Показать</strong> <a href="#">мои</a> сообщения</li>
    </ul>
</div>
<? $form = $this->beginWidget('CActiveForm', [
	'id' => 'query-form',
	'action' => '/forum',
	'enableAjaxValidation' => true,
	'htmlOptions' => ['role' => 'form'],
]); ?>
	<div class="filters-search">
		<div class="row">
			<div class="col-sm-4">
				<input class="form-control form-control-sm" type="text" placeholder="Введите слово или фразу" name="FilterSearchForm[query]">
			</div>
			<div class="col-sm-6">
				<div class="row filters-search-select-block">
					<label for="filters-search-Select" class="col-sm-4 filters-search-select__label">в разделе:</label>
					<div class="col-sm-8">
						<select class="form-control form-control-sm" id="filters-search-Select" name="FilterSearchForm[sections_id]">
						<option value="all">Во всех</option>
						<? foreach($sections as $section): ?>
							<option value="<?= $section->id ?>"><?= $section->title ?></option>
						<? endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-2 search-btn">
			<button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit">Искать</button>
			</div>
		</div>
	</div>
<? $this->endWidget(); ?>