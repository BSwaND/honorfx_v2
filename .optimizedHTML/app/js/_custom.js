document.addEventListener("DOMContentLoaded", function() {

	jQuery(window).scroll(function() {
		var q = jQuery(this);
		var goToUp = document.querySelector(".btn-up");

		if (q.scrollTop() > 800) {
			goToUp.classList.add("btn-up_active");
		} else{
			goToUp.classList.remove("btn-up_active");
		}
	});
	jQuery('.btn-up').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});


	jQuery('.hamburger').click(function (){
		jQuery(this).toggleClass('is-active');
		jQuery('.header .header_nav').fadeToggle(400);
	})

	new WOW().init();


});
