var extreme_app = (function(){
	var check = function() {
		if($('#HolderPhoto img').length != 0) {
			return true;
		} else {
			return false;
		}
	}

	$(document).on('click', '.app-logo-ext', function(){
		if(check()) {
			$('.logo-ext').toggleClass('active');
			if($('.logo-ext').hasClass('active')) {
				$('input[name=logo-extreme]').val('yes');
			} else {
				$('input[name=logo-extreme]').val('no');
			}
		}
		return false;
	});

	$(document).on('click', '.app-logo-hou', function(){
		if(check()) {
			$('.logo-hou').toggleClass('active');
			if($('.logo-hou').hasClass('active')) {
				$('input[name=logo-hours]').val('yes');
			} else {
				$('input[name=logo-hours]').val('no');
			}
		}
		return false;
	});

	$(document).on('click', '.ice-item', function(){
		if(!check()) return;
		$('input[name=filter]').val($(this).find('.ice-cream').attr('data-ice'));
		$('.ice-item').removeClass('active');
		$(this).addClass('active');
		var filter = $(this).find('.ice-cream').attr('data-ice');
		$('.app-overlay').removeAttr('stlye').css('background', 'url(img/application/overlays/filter-' + filter + '.png)');
		return false;
	});
})();