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


	function SelectBlockInitialization(element){
		let selectBlockInitializationClass = document.querySelectorAll('.'+element.selectBlockInitializationClass);
		let selectBlockBtnClass = element.selectBlockBtnClass;
		let selectBlockBtnClassActive = element.selectBlockBtnClassActive;
		let popApBlockClass = element.popApBlockClass;
		let popApBlockClassActive = element.popApBlockClassActive;
		let tagLiClassInPopAp = element.tagLiClassInPopAp;

		selectBlockInitializationClass.forEach((el) =>{
			let selectTag =  el.querySelector('select');
			templateBlockPopap(el.querySelector('.' + selectBlockBtnClass), selectTag.options);
			deployValueInSelectOnClick(el);

			el.querySelectorAll('.'+selectBlockBtnClass).forEach((el) =>{
				el.addEventListener('click', function (e){
					if (e.target  === this || e.target == this.querySelector('span')) {
						console.log('click btn')
						console.log(e.target)
						let curentPopApBlokUL =  this.querySelector(`.${popApBlockClass}`);
						this.classList.toggle(selectBlockBtnClassActive);
						curentPopApBlokUL.classList.toggle(popApBlockClassActive);

						// document.addEventListener('click', function (){
						// 		curentPopApBlokUL.classList.remove(popApBlockClassActive);
						// 	},{capture:true}
						// )

					} else {
						// console.log('no btn')
						console.log(e.target)
					}


				})
			})
		})

		function templateBlockPopap(parentBlock, elementItaration){
			let outerDiv = document.createElement('div');
			let ul = document.createElement('ul');
			outerDiv.className = popApBlockClass;
			for(let i = 0; elementItaration.length > i; i++){
				if(elementItaration[i].value){
					ul.innerHTML += `<li data-value="${elementItaration[i].value}" class="${tagLiClassInPopAp}">${elementItaration[i].innerHTML}</li>`;
				}
			}
			if(parentBlock.parentNode.querySelector('input')){
				let input = parentBlock.parentNode.querySelector('input');
				outerDiv.append(input);
				input.addEventListener('click', function (e){
					console.log(e)
				},{capture:true})
			}
			outerDiv.append(ul);
			parentBlock.append(outerDiv);
		}

		function deployValueInSelectOnClick(el){
			let liOptions = el.querySelectorAll('.'+tagLiClassInPopAp);

			liOptions.forEach((i)=>{
				i.addEventListener('click', function (){
					el.querySelector('select').value = this.getAttribute('data-value');
					el.querySelector('.'+selectBlockBtnClass + ' span').innerHTML = this.innerHTML;
					removeClass(el)
					console.log('select>value = ' + el.querySelector('select').value)
				})
			})
		}

		function removeClass(el){
			el.querySelector(`.${popApBlockClass}`)
				.classList.remove(popApBlockClassActive);
			el.querySelector(`.${selectBlockBtnClass}`)
				.classList.remove(selectBlockBtnClassActive);
		}
	}


	let selectBlockInitializationColRow = new SelectBlockInitialization({
		selectBlockInitializationClass: 'qqq',
		selectBlockBtnClass: 'select-block_btn',
		selectBlockBtnClassActive: 'select-block_btn__open',
		popApBlockClass: 'select-block_popap',
		popApBlockClassActive: 'select-block_popap__active',
		tagLiClassInPopAp: 'select-block_popap__li', //default
	})


});
