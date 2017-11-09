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
<? $form = $this->beginWidget('CActiveForm', [
	'id' => 'actions-form',
	'action' => '/forum',
	'enableAjaxValidation' => true,
	'htmlOptions' => ['role' => 'form'],
]); ?>
	<? if($this->user->role == 'admin'): ?>
		<div class="categories-editor">
			<div class="row">
				<div class="col-sm-10">
					<select class="form-control form-control-sm" name="action">
						<option value="nothing" selected="selected">Выберите действие</option>
						<option value="hide">Скрыть</option>
						<option value="show">Показать</option>
						<option value="delete">Удалить</option>
					</select>
				</div>
				<div class="col-sm-2"><button class="btn btn-outline-success my-sm-0 btn-sm" category="submit" name="submit" value="save">Применить</button></div>
			</div>
		</div>
	<? endif ?>
	<div class="forum-block-main">
		<table class="table table-bordered">
			<thead>
				<tr class="table-active">
					<th>Раздел &nbsp;&nbsp;<? if($this->user->role == 'admin'): ?><a href="<?= Funcs::base() ?>/sectionscreate/" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">Создать раздел</a><? endif ?></th>
					<th class="td-0 text-center">Тем</th>
					<th class="td-0 text-center">Сообщений</th>
					<? if($this->user->role == 'admin'): ?>
						<th class="td-0 text-center"><i class="fa fa-eye"></i></th>
						<th class="td-0 text-center"><i class="fa fa-check-square-o"></i></th>
						<th class="td-0 text-center"><i class="fa fa-wrench"></i></th>
					<? endif ?>
				</tr>
			</thead>
			<tbody>
				<? foreach($sections as $section): ?>
					<tr>
						<td>
							<a href="#" class="forum-sections-link"><?= $section->title ?></a>
							<? if(isset($section->description) && !empty($section->description)): ?>
								<div class="forum-sections-descriptions">
									<?= Funcs::cropLongText($section->description, 60, true) ?>
								</div>
							<? endif ?>
						</td>
						<td class="td-0 text-center">0</td>
						<td class="td-0 text-center">0</td>
						<? if($this->user->role == 'admin'): ?>
							<td class="text-center" style="color: #808080">
								<? if($section->visible == 0): ?>
									<i class="fa fa-eye-slash" aria-hidden="true"></i>
								<? else: ?>
									<i class="fa fa-eye" aria-hidden="true"></i>
								<? endif ?>
							</td>
							<td class="text-center">
								<input name="id[<?= $section->id ?>]" type="checkbox" value="<?= $section->id ?>">
							</td>
							<td class="text-center">
								<a href="<?= Funcs::base() ?>/sectionedit/id/<?= $section->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								<a href="<?= Funcs::base() ?>/sectiondelete/id/<?= $section->id ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						<? endif ?>
					</tr>
				<? endforeach ?>
			</tbody>
		</table>
	</div>
<? $this->endWidget(); ?>