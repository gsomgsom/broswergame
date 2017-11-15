'use strict';

( function() {
	CKEDITOR.plugins.add( 'test', {
		requires: 'widget,dialog',
		lang: 'en,ru',
		icons: 'test',
		hidpi: true,

		onLoad: function() {
			// Стиль вывода виджета
			CKEDITOR.addCss( '.cke_test{background-color:#ff0}' );
		},

		init: function( editor ) {

			var lang = editor.lang.test;

			// Диалог
			CKEDITOR.dialog.add( 'test', this.path + 'dialogs/test.js' );

			// Инициализация
			editor.widgets.add( 'test', {
				dialog: 'test',
				pathName: lang.pathName,
				// Чтобы не было конфликтов с диалогом нужно сделать обёртку
				template: '<span class="cke_test">[]</span>',

				downcast: function() {
					return new CKEDITOR.htmlParser.text( '[test id="' + this.data.id + '"]' );
				},

				init: function() {
					// Таким грубым способом мы получаем id (надо бы переписать в regexp)
					this.setData( 'id', this.element.getText().slice( 10, -2 ) );
				},

				data: function( data ) {
					this.element.setText( '[test id="' + this.data.id + '"]' );
				}
			} );

			editor.ui.addButton && editor.ui.addButton( 'Createtest', {
				label: lang.toolbar,
				command: 'test',
				toolbar: 'others', // В какой тулбар вставлять
				icon: 'test'
			} );
		},

		afterInit: function( editor ) {
			var testReplaceRegex = /\[test([^\[\]])+\]/g;

			editor.dataProcessor.dataFilter.addRules( {
				text: function( text, node ) {
					var dtd = node.parent && CKEDITOR.dtd[ node.parent.name ];

					// Вешаем обработчик на DTD <span>
					if ( dtd && !dtd.span )
						return;

					return text.replace( testReplaceRegex, function( match ) {
						var widgetWrapper = null,
							innerElement = new CKEDITOR.htmlParser.element( 'span', {
								'class': 'cke_test'
							} );

						innerElement.add( new CKEDITOR.htmlParser.text( match ) );
						widgetWrapper = editor.widgets.wrapElement( innerElement, 'test' );

						return widgetWrapper.getOuterHtml();
					} );
				}
			} );
		}
	} );

} )();
