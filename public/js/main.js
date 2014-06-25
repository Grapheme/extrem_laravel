var Slider = (function(){
	var $container = $('.ice-cream-slider');
	var $slide = $('.ice-cream-slider .slide');
	var $desc = $('.desc-slide');
	var $current;
	var $currentDesc;
	var $size = $slide.length;
	var $next = $('.arrow-right');
	var $prev = $('.arrow-left');
	var $arrow = $('[data-arrow]');
	var $main = $('main');

	return {
		init: function() {
			$slide.first().addClass('active');
			$desc.first().addClass('active');
			$current = $('.slide.active').index();
			$currentDesc = $('.desc-slide.active');

			$(document).on('click', '.arrow-right', function(){
				if ( $(this).hasClass('disabled') ) {
					return;
				}
				Slider.next();
			});
			$(document).on('click', '.arrow-left', function(){
				if ( $(this).hasClass('disabled') ) {
					return;
				}
				Slider.prev();
			});
		},

		next: function() {
			if ($prev.hasClass('disabled')) {
				$prev.removeClass('disabled');
			}

			if ($current < $size) {
				$current = $('.slide.active').removeClass('active').addClass('passed').next().addClass('active').index();
				$currentDesc = $('.desc-slide.active').removeClass('active').addClass('passed').next().addClass('active').index();
				$arrow.attr({'data-arrow': $current});
				$main.attr({'data-bg': $current});

				if ($current == $size) {
					$next.addClass('disabled');
				}
			}

			console.log($current, $size);
		},

		prev: function() {
			if ($next.hasClass('disabled')) {
				$next.removeClass('disabled');
			}

			if ($current > 0) {
				$current = $('.slide.active').removeClass('active').prev().addClass('active').removeClass('passed').index();
				$currentDesc = $('.desc-slide.active').removeClass('active').prev().addClass('active').removeClass('passed').index();
				$arrow.attr({'data-arrow': $current});
				$main.attr({'data-bg': $current});

				if ($current === 1) {
					$prev.addClass('disabled');
				}
			}
		}
	};
})();

var Popup = (function(){
	var $popup_1 = $('[data-popup="1"]'),
		$popup_2 = $('[data-popup="2"]'),
		$popup_3 = $('[data-popup="3"]'),
		$popup_4 = $('[data-popup="4"]'),
		$popup_5 = $('[data-popup="5"]'),
		$popup_6 = $('[data-popup="6"]'),
		$close = $('.popup-close'),
		$overlay = $('.overlay'),
		$popupArr = $('.popup'),
		$mainWrapper = $('.main-wrapper'),

		$photoTrggr = $('#app'),
		$advicesTrggr = $('#advices'),
		$eventsTrggr = $('#events'),
		$bloggers = $('#bloggers');

	function openPopup(elem) {
		$overlay.removeClass('hidden');
		elem.removeClass('hidden').addClass('active');
		setTimeout( function(){
			var $height1 = $('.popup.active .column-content').height() + 430;
			var $height2 = $mainWrapper.height();
			var finishHeight = ($height1 >= $height2)? $height1: $height2;
			$overlay.height( finishHeight );
			$mainWrapper.height( finishHeight );
		}, 100);
	}
	function closePopup() {
		$overlay.addClass('hidden').removeAttr('style');
		$mainWrapper.removeAttr('style');
		$popupArr.addClass('hidden');
		$('#load-photo').removeClass('uploaded');
	}
	function alignOverlay() {

	}

	$(document).on('click', '#app', function(){
		openPopup($popup_3);
	});
	$(document).on('click', '#app2', function(){
		openPopup($popup_6);
	});
	$(document).on('click', '#advices', function(){
		openPopup($popup_1);
	});
	$(document).on('click', '#events', function(){
		openPopup($popup_5);
	});
	$(document).on('click', '#bloggers', function(){
		openPopup($popup_2);
	});
	$(document).on('click', '.popup', function(e){
		e.stopPropagation();
	});
	$(document).on('click', '.popup-close, .overlay', function(){
		closePopup();
	});

	var slide_allow = true;
	$(document).on('click', '.column-list li', function(){
		if(!slide_allow) return;
		slide_allow = false;
		$(this).slideUp();
		$('.column-list li').not(':visible').slideDown();
		$('.column-content').addClass('hidden');
		$('.column-content').eq($(this).index()).removeClass('hidden');
		setTimeout(function(){
			slide_allow = true;
		}, 500);
	});
})();

Slider.init();

$(document).ready(function(){
	$('button.photo-save').click(function(e){	
		$(this).html('Пожалуйста подождите ...');
	});
});




