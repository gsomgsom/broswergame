'use strict';

CKEDITOR.dialog.add( 'test', function( editor ) {
	var lang = editor.lang.test,
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
						type: 'text',
						style: 'width: 100%;',
						label: lang.id,
						'default': '123',
						required: true,
						validate: CKEDITOR.dialog.validate.regex( validNameRegex, lang.invalidId ),
						setup: function( widget ) {
							this.setValue( widget.data.id );
						},
						commit: function( widget ) {
							widget.setData( 'id', this.getValue() );
						}
					}
				]
			}
		]
	};
} );