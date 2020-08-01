jQuery(document).ready(function() {
	var $ = jQuery;
	if ($('.set_custom_images').length > 0) {
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
			$('.set_custom_images').on('click', function(e) {
				e.preventDefault();
				var button = $(this);
				var id = button.prev();
				wp.media.editor.send.attachment = function(props, attachment) {
					if(attachment.subtype != 'pdf'){
						alert('Không đúng định dạng file'); return false
					}
					id.val(attachment.url);
				};
				wp.media.editor.open(button);
				return false;
			});
		}
	}
});
