<? $this->widget('ForumFilterBlock') ?>

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
							<a href="<?= Funcs::base() ?>/forum/topics/view/id/<?= $section->id ?>" class="forum-sections-link"><?= $section->title ?></a>
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