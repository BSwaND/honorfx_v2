document.addEventListener("DOMContentLoaded", function() {
	let btn = document.querySelector('.btn-close');
	let modal = document.querySelector('.modal');
	btn.onclick = function (){
		modal.classList.toggle("modal__open")
	}
})
