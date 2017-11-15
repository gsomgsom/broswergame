'use strict';

( function() {
	CKEDITOR.plugins.add( 'include', {
		requires: 'widget,dialog',
		lang: 'en,ru',
		icons: 'include',
		hidpi: true,

		onLoad: function() {
			// Стиль вывода виджета
			CKEDITOR.addCss( '.cke_include{background-color:#000;color:#fff}' );
		},

		init: function( editor ) {

			var lang = editor.lang.include;

			// Диалог
			CKEDITOR.dialog.add( 'include', this.path + 'dialogs/include.js' );

			// Инициализация
			editor.widgets.add( 'include', {
				dialog: 'include',
				pathName: lang.pathName,
				// Чтобы не было конфликтов с диалогом нужно сделать обёртку
				template: '<span class="cke_include">[]</span>',

				downcast: function() {
					return new CKEDITOR.htmlParser.text( '[include file="' + this.data.file + '"]' );
				},

				init: function() {
					// Таким грубым способом мы получаем file (надо бы переписать в regexp)
					this.setData( 'file', this.element.getText().slice( 15, -2 ) );
				},

				data: function( data ) {
					this.element.setText( '[include file="' + this.data.file + '"]' );
				}
			} );

			editor.ui.addButton && editor.ui.addButton( 'Createinclude', {
				label: lang.toolbar,
				command: 'include',
				toolbar: 'others', // В какой тулбар вставлять
				icon: 'include'
			} );
		},

		afterInit: function( editor ) {
			var includeReplaceRegex = /\[include([^\[\]])+\]/g;

			editor.dataProcessor.dataFilter.addRules( {
				text: function( text, node ) {
					var dtd = node.parent && CKEDITOR.dtd[ node.parent.name ];

					// Вешаем обработчик на DTD <span>
					if ( dtd && !dtd.span )
						return;

					return text.replace( includeReplaceRegex, function( match ) {
						var widgetWrapper = null,
							innerElement = new CKEDITOR.htmlParser.element( 'span', {
								'class': 'cke_include'
							} );

						innerElement.add( new CKEDITOR.htmlParser.text( match ) );
						widgetWrapper = editor.widgets.wrapElement( innerElement, 'include' );

						return widgetWrapper.getOuterHtml();
					} );
				}
			} );
		}
	} );

} )();
