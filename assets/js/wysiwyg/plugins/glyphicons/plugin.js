/*
	Author	: Michael Janea (https://facebook.com/mbjanea)
	Version	: 1.0
*/

CKEDITOR.plugins.add('glyphicons',{icons:'glyphicons',init:function(editor){var iconPath=this.path+'images/glyphicons.png';editor.addCommand('glyphiconsDialog',new CKEDITOR.dialogCommand('glyphiconsDialog'));editor.ui.addButton('Glyphicons',{label:'Insert Glyphicons',command:'glyphiconsDialog',toolbar:'document'});CKEDITOR.dialog.add('glyphiconsDialog',this.path+'dialogs/glyphicons.js')}});