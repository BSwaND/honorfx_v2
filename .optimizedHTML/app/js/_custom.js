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


});
