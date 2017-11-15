'use strict';

(function() {
	CKEDITOR.plugins.add('gallery', {
		requires: 'widget,dialog',
		lang: 'en,ru',
		icons: 'gallery',
		hidpi: true,

		onLoad: function() {
			// Стиль вывода виджета
			CKEDITOR.addCss('.cke_gallery{background-color:#ff0}');
		},

		init: function(editor) {

			var lang = editor.lang.gallery;

			// Диалог
			CKEDITOR.dialog.add('gallery', this.path + 'dialogs/gallery.js');

			// Инициализация
			editor.widgets.add('gallery', {
				dialog: 'gallery',
				pathName: lang.pathName,
				// Чтобы не было конфликтов с диалогом нужно сделать обёртку
				template: '<span class="cke_gallery">[]</span>',

				downcast: function() {
					return new CKEDITOR.htmlParser.text('[gallery id="' + this.data.id + '"]');
				},

				init: function() {
					// Таким грубым способом мы получаем id (надо бы переписать в regexp)
					this.setData('id', this.element.getText().slice(13, -2));
				},

				data: function(data) {
					this.element.setText('[gallery id="' + this.data.id + '"]');
				}
			});

			editor.ui.addButton && editor.ui.addButton('Creategallery', {
				label: lang.toolbar,
				command: 'gallery',
				toolbar: 'others', // В какой тулбар вставлять
				icon: 'gallery'
			});
		},

		afterInit: function(editor) {
			var galleryReplaceRegex = /\[gallery([^\[\]])+\]/g;

			editor.dataProcessor.dataFilter.addRules({
				text: function(text, node) {
					var dtd = node.parent && CKEDITOR.dtd[ node.parent.name ];

					// Вешаем обработчик на DTD <span>
					if (dtd && !dtd.span)
						return;

					return text.replace(galleryReplaceRegex, function(match) {
						var widgetWrapper = null,
							innerElement = new CKEDITOR.htmlParser.element('span', {
								'class': 'cke_gallery',
							});

						innerElement.add(new CKEDITOR.htmlParser.text(match));
						widgetWrapper = editor.widgets.wrapElement(innerElement, 'gallery');

						return widgetWrapper.getOuterHtml();
					});
				}
			});
		}
	});

})();
