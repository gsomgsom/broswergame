<div class="container">
	<ul class="breadcrumbs">
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/forum" class="breadcrumbs__link">Форум</a>
		</li>
		<li class="breadcrumbs__item">
			<?= $section->title ?>
		</li>
	</ul>
</div>

<? $this->widget('ForumFilterBlock') ?>

<? $form = $this->beginWidget('CActiveForm', [
	'id' => 'actions-form',
	'action' => '/forum/topics/view/id/'.$section->id,
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
						<option value="consolidate">Закрепить</option>
						<option value="unfasten">Открепить</option>
						<option value="open">Открыть</option>
						<option value="close">Закрыть</option>
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
					<th>Тема &nbsp;&nbsp;<? if($this->user->role == 'admin'): ?><a href="<?= Funcs::base() ?>/topicscreate/" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">Создать тему</a><? endif ?></th>
					<th class="td-0 text-center">Ответов</th>
					<? if($this->user->role == 'admin'): ?>
						<th class="td-0 text-center"><i class="fa fa-eye"></i></th>
						<th class="td-0 text-center"><i class="fa fa-check-square-o"></i></th>
						<th class="td-0 text-center"><i class="fa fa-wrench"></i></th>
					<? endif ?>
				</tr>
			</thead>
			<tbody>
				<? foreach($topics as $topic): ?>
					<? if($topic->fixed == 1): ?>
						<tr class="table-success">
							<td>
								<a href="<?= Funcs::base() ?>/forum/post/view/id/<?= $topic->id ?>" class="forum-sections-link"><?= $topic->title ?></a>
							</td>
							<td class="td-0 text-center">0</td>
							<? if($this->user->role == 'admin'): ?>
								<td class="text-center" style="color: #808080">
									<? if($topic->visible == 0): ?>
										<i class="fa fa-eye-slash" aria-hidden="true"></i>
									<? else: ?>
										<i class="fa fa-eye" aria-hidden="true"></i>
									<? endif ?>
								</td>
								<td class="text-center">
									<input name="id[<?= $topic->id ?>]" type="checkbox" value="<?= $topic->id ?>">
								</td>
								<td class="text-center">
									<a href="<?= Funcs::base() ?>/sectionedit/id/<?= $topic->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="<?= Funcs::base() ?>/sectiondelete/id/<?= $topic->id ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
								</td>
							<? endif ?>
						</tr>
					<? endif ?>
				<? endforeach ?>
				<? foreach($topics as $topic): ?>
					<? if($topic->fixed == 0 && $topic->closed == 0): ?>
						<tr>
							<td>
								<a href="<?= Funcs::base() ?>/forum/post/view/id/<?= $topic->id ?>" class="forum-sections-link"><?= $topic->title ?></a>
							</td>
							<td class="td-0 text-center">0</td>
							<? if($this->user->role == 'admin'): ?>
								<td class="text-center" style="color: #808080">
									<? if($topic->visible == 0): ?>
										<i class="fa fa-eye-slash" aria-hidden="true"></i>
									<? else: ?>
										<i class="fa fa-eye" aria-hidden="true"></i>
									<? endif ?>
								</td>
								<td class="text-center">
									<input name="id[<?= $topic->id ?>]" type="checkbox" value="<?= $topic->id ?>">
								</td>
								<td class="text-center">
									<a href="<?= Funcs::base() ?>/sectionedit/id/<?= $topic->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="<?= Funcs::base() ?>/sectiondelete/id/<?= $topic->id ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
								</td>
							<? endif ?>
						</tr>
					<? endif ?>
				<? endforeach ?>
				<? foreach($topics as $topic): ?>
					<? if($topic->closed == 1): ?>
						<tr>
							<td>
								&nbsp;&nbsp;&nbsp;<i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a href="<?= Funcs::base() ?>/forum/post/view/id/<?= $topic->id ?>" class="forum-sections-link"><?= $topic->title ?></a>
							</td>
							<td class="td-0 text-center">0</td>
							<? if($this->user->role == 'admin'): ?>
								<td class="text-center" style="color: #808080">
									<? if($topic->visible == 0): ?>
										<i class="fa fa-eye-slash" aria-hidden="true"></i>
									<? else: ?>
										<i class="fa fa-eye" aria-hidden="true"></i>
									<? endif ?>
								</td>
								<td class="text-center">
									<input name="id[<?= $topic->id ?>]" type="checkbox" value="<?= $topic->id ?>">
								</td>
								<td class="text-center">
									<a href="<?= Funcs::base() ?>/sectionedit/id/<?= $topic->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="<?= Funcs::base() ?>/sectiondelete/id/<?= $topic->id ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
								</td>
							<? endif ?>
						</tr>
					<? endif ?>
				<? endforeach ?>
			</tbody>
		</table>
	</div>
<? $this->endWidget(); ?>