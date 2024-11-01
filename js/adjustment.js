// Disabilita o overflow da tag section
function disableOverflor(){
	(function ($) {

		$(document).ready(function(){
			$('section.section').css('overflow', 'visible');
		});	

	}(jQuery));
}

// Habilita o overflow da tag section
function enableOverflor(){
	(function ($) {

		$(document).ready(function(){
			$('section.section').css('overflow', 'hidden');
		});	

	}(jQuery));
}

