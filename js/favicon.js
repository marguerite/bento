$(document).ready(function() {
	$('.entry a, .comment p a').each(function() {
	    // detect if link has href
	    if (typeof($(this).attr('href')) != "undefined" ) {
		var faviconURL = $(this).attr('href').replace(/^(http(s)?:\/\/[^\/]+).*$/, '$1')+'/favicon.ico';
		var if_image = new Image();
		  if_image.src = faviconURL;
		  // detect if don't has children (usually an image); and the real favicon is accessable.
		if ($(this).children().length <= 0 && if_image.width > 0) {
		  $(this).before('<img height=\"16px\" width=\"16px\" style=\"margin-right:2px;\" src=\"'+faviconURL+'\"/>');
		  }
		// SuSE related sites hack
		// detec herf contains suse.
		else if ( $(this).attr('href').indexOf('suse') != -1 && $(this).children().length <= 0) {
		  $(this).before("<img height=\"16px\" width=\"16px\" style=\"margin-right:2px;\" src=\"http://static.opensuse.org/themes/bento/images/favicon.png\"/>");
		}
		// KDE related sites hack
		else if ( $(this).attr('href').indexOf('kde') != -1 && $(this).children().length <= 0) {
		  $(this).before("<img height=\"16px\" width=\"16px\" style=\"margin-right:2px;\" src=\"http://kde.org/media/images/favicon.ico\"/>");
		}
		// GNOME releated sites hack		
		else if ( $(this).attr('href').indexOf('gnome') != -1 && $(this).children().length <= 0) {
		  $(this).before("<img height=\"16px\" width=\"16px\" style=\"margin-right:2px;\" src=\"http://blogs.gnome.org/favicon.ico\"/>");
		}	
		// Fedora related sites hack
		else if ( $(this).attr('href').indexOf('fedora') != -1 && $(this).children().length <= 0) {
		  $(this).before("<img height=\"16px\" width=\"16px\" style=\"margin-right:2px;\" src=\"http://fedoraproject.org/static/images/favicon.ico\"/>");
		}
		// Ubuntu related sites hack
		else if ( $(this).attr('href').indexOf('ubuntu') != -1 && $(this).children().length <= 0) {
		  $(this).before("<img height=\"16px\" width=\"16px\" style=\"margin-right:2px;\" src=\"http://ubuntu.com/sites/all/themes/ubuntu10/favicon.ico\"/>");
		}
		// GIMP related sites hack
		else if ( $(this).attr('href').indexOf('gimp') != -1 && $(this).children().length <= 0) {
		  $(this).before("<img height=\"16px\" width=\"16px\" style=\"margin-right:2px;\" src=\"http://gimp.org/images/wilber16.png\"/>");
		}
		else {
		  // do not add judgement here, use another "else if".
		}
	    }
	    });
});
