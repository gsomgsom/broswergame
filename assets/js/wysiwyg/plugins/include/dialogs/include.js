'use strict';

CKEDITOR.dialog.add( 'include', function( editor ) {
	var lang = editor.lang.include,
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
						id: 'file',
						type: 'text',
						style: 'width: 100%;',
						label: lang.file,
						'default': '123',
						required: true,
						validate: CKEDITOR.dialog.validate.regex( validNameRegex, lang.invalidFile ),
						setup: function( widget ) {
							this.setValue( widget.data.file );
						},
						commit: function( widget ) {
							widget.setData( 'file', this.getValue() );
						}
					}
				]
			}
		]
	};
} );