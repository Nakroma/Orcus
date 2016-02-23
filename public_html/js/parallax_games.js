jQuery(document).ready(function(){
  $(window).scroll(function(e){
  	parallaxScroll();
	});
	 
	function parallaxScroll(){
		var scrolled = $(window).scrollTop();
		$('.suggested-match-bg').css('bottom', (-100-(0.8*scrolled)) + 'px');
	}
 }); 