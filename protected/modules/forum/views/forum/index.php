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
<form>
	<div class="filters-search">
		<div class="row">
			<div class="col-sm-4">
				<input class="form-control form-control-sm" type="text" placeholder="Введите слово или фразу">
			</div>
			<div class="col-sm-6">
				<div class="row filters-search-select-block">
					<label for="filters-search-Select" class="col-sm-4 filters-search-select__label">в разделе:</label>
					<div class="col-sm-8">
						<select class="form-control form-control-sm" id="filters-search-Select">
						<option>Во всех</option>
						<option>Изобретальня</option>
						<option>Бар "Дикий Шмель"</option>
						<option>Приёмная</option>
						<option>Таверна</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-2 search-btn">
			<button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit">Искать</button>
			</div>
		</div>
	</div>
	<div class="categories-editor">
		<div class="row">
			<div class="col-sm-10">
				<select class="form-control form-control-sm">
					<option value="nothing" selected="selected">Выберите действие</option>					
					<option value="hide">Скрыть</option>
					<option value="show">Показать</option>
					<option value="delete">Удалить</option>
				</select>
			</div>
			<div class="col-sm-2"><button class="btn btn-outline-success my-sm-0 btn-sm" type="submit">Применить</button></div>
		</div>
	</div>
	<div>
		<table class="table table-bordered">
			<thead>
				<tr class="table-active">
					<th>Раздел</th>
					<th class="td-0 text-center">Тем</th>
					<th class="td-0 text-center">Сообщений</th>
					<th class="td-0 text-center"><i class="fa fa-eye"></i></th>
					<th class="td-0 text-center"><i class="fa fa-check-square-o"></i></th>
					<th class="td-0 text-center"><i class="fa fa-wrench"></i></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>MarkMarkMarkMark</td>
					<td class="td-0 text-center">0</td>
					<td class="td-0 text-center">0</td>
					<td class="text-center" style="color: #808080">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<?/* if($model->visible == 0): ?>
							<i class="fa fa-eye-slash" aria-hidden="true"></i>
						<? else: ?>
							<i class="fa fa-eye" aria-hidden="true"></i>
						<? endif */?>
					</td>
					<td class="text-center">
						<input name="id[]" type="checkbox" value="">
					</td>
					<td class="text-center">
						<a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>