(function($){
	$(document).ready(function(){
		$('select.formatted').selectbox();
		
		$('#knockit, #dunkit, #freezeit').hover(function(){
			$(this).find('img').stop().animate({
				opacity: 1
			}, 100);
		}, function(){
			$(this).find('img').stop().animate({
				opacity: 0
			}, 250);
		}).find('img').css({
			opacity: 0
		});
	});
})(jQuery);