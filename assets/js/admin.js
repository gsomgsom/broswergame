$(function () {
	// WYSIWYG
	$('.wysiwyg').ckeditor();

	// Кнопка удаления позиции
	$('.remove-entry-btn').click(function(){
		if (confirm('Удалить позицию ?')) {
			document.location = $(this).attr('data-link');
		}
		return false;
	});
});
