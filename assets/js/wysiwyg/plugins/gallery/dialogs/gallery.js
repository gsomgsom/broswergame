'use strict';

CKEDITOR.dialog.add('gallery', function(editor) {
	var lang = editor.lang.gallery,
		generalLabel = editor.lang.common.generalTab,
		validNameRegex = /^[^\[\]\<\>]+$/;

	return {
		title: lang.title,
		minWidth: 300,
		minHeight: 80,
		contents: [
			{
				id: 'info',
				label: generalLabel,
				title: generalLabel,
				elements: [
					// Dialog window UI elements.
					{
						id: 'id',
						type: 'select',
						style: 'width: 295px;',
						label: lang.select_gallery,
						items: galleriesList,
						required: true,
						validate: CKEDITOR.dialog.validate.regex(validNameRegex, lang.invalidId),
						setup: function(widget) {
							this.setValue(widget.data.id);
						},
						commit: function(widget) {
							widget.setData('id', this.getValue());
						}
					}
				]
			}
		]
	};
});
