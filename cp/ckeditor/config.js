/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'th';
	 //config.uiColor = '#AADC6E';

	config.extraPlugins = 'image';
	config.filebrowserUploadUrl = 'ckupload.php';
	config.image_removeLinkByEmptyURL= true;
	config.image_previewText = CKEDITOR.tools.repeat( 'ตัวอย่างรูปภาพ ', 100 );
	
	config.extraPlugins = 'filebrowser';
	config.extraPlugins = 'popup';

};

CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?Type=Images',
    filebrowserFlashBrowseUrl: '/ckfinder/ckfinder.html?Type=Flash',
    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});