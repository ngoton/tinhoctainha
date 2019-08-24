/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        config.filebrowserBrowseUrl ='/blog/js/edit/ckfinder/ckfinder.html';
        config.filebrowserImageBrowseUrl = '/blog/js/edit/ckfinder/ckfinder.html?type=Images';
        config.filebrowserFlashBrowseUrl = '/blog/js/edit/ckfinder/ckfinder.html?type=Flash';
        config.filebrowserUploadUrl = '/blog/js/edit/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
        config.filebrowserImageUploadUrl = '/blog/js/edit/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
        config.filebrowserFlashUploadUrl = '/blog/js/edit/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
