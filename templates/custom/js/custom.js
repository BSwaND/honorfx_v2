document.addEventListener("DOMContentLoaded", function () {

function langDropdownList(){
	const switchLange = document.querySelector('.switch_lange');
	const langDropdownList = document.querySelector('.lang_dropdown');

	if(!langDropdownList) return;
	window.addEventListener('click', (e) => {
		const target = e.target;
		if (!target.closest('.switch_lange')) {
			switchLange.classList.remove('switch_lange--active');
			langDropdownList.classList.remove('lang_dropdown__open');
		}
	});
	switchLange.addEventListener('click', () => {
		switchLange.classList.toggle('switch_lange--active');
		langDropdownList.classList.toggle('lang_dropdown__open');
	});
} langDropdownList();

	const swiperFirst = new Swiper('.swiper-container.forex', {
		direction: 'horizontal',
		slidesPerView: 2,
		width: 255,

		pagination: {
			el: '.forex-pagin',
			clickable: true
		},
	});

	const swiperSecond = new Swiper('.swiper-container.futures', {
		direction: 'horizontal',
		slidesPerView: 2,
		width: 255,

		pagination: {
			el: '.futures-pagin',
			clickable: true
		},
	});

	const swiperThird = new Swiper('.swiper-container.stocks', {
		direction: 'horizontal',
		slidesPerView: 2,
		width: 255,

		pagination: {
			el: '.stocks-pagin',
			clickable: true
		},
	});

	const swiperFourth = new Swiper('.swiper-container.indices', {
		direction: 'horizontal',
		slidesPerView: 2,
		width: 255,

		pagination: {
			el: '.indices-pagin',
			clickable: true
		},
	});

	const swiperFifth = new Swiper('.swiper-container.crypto', {
		direction: 'horizontal',
		slidesPerView: 2,
		width: 255,

		pagination: {
			el: '.crypto-pagin',
			clickable: true
		},
	});

	const swiperTrading = new Swiper('.swiper-container.trading', {
		direction: 'horizontal',
		// slidesPerView: 1,
		slidesPerView: 'auto',
		slidesPerGroup: 1,

		pagination: {
			el: '.trading-pagin',
			clickable: true
		},
	});

	const swiperContactsLocation = new Swiper('.swiper-container.contact-us__slider', {
		direction: 'horizontal',
		slidesPerView: 3,
		slidesPerGroup: 1,

		navigation: {
			nextEl: '.ctm-btn-next',
			prevEl: '.ctm-btn-prev',
		},

		pagination: {
			el: '.ctm-pagin__location',
			clickable: true,
		},
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			768: {
				slidesPerView: 2,
			},
			1280: {
				slidesPerView: 3,
			}
		}
	});


// function resize() {
//   const mobileWidth = 533;
//   const width = window.innerWidth;
//   width <= mobileWidth ? swiperContactsLocation.destroy('true', 'true') : false;
// }

// window.onresize = resize;

	const tableCustomMobailItemElems = document.querySelectorAll('.table-custom-mobail_item_head');

	tableCustomMobailItemElems.forEach(elem => {
		elem.addEventListener('click', e => {
			elem.classList.toggle('table-custom-mobail_item--rotate');
		});
	});

	const thanksCtmContainerElem = document.querySelector('.ctm-container');
	const thanksCtmAnimateElem = document.querySelector('.ctm-animate');
	const thanksCtmWrappElem = document.querySelector('.ctm-thank-block .text-center ');

	if (thanksCtmContainerElem !== null) {
		thanksCtmContainerElem.addEventListener('click', () => {
			thanksCtmAnimateElem.classList.toggle('ctm-animate--active');
			thanksCtmWrappElem.classList.toggle('ctm-animate--active');
		});
	}

	const openLiveChatBtn = document.querySelector('#openLiveChat');
	const openLiveChatConsult = document.querySelector('#openLiveChatConsult');
	const openLiveChatHelpDoc = document.querySelector('#openLiveChatHelpDoc');

	function allBtnsOpenLiveChat(btn) {
		const openLiveChatWdg = () => LiveChatWidget.call('maximize');
		btn !== null ? btn.addEventListener('click', () => openLiveChatWdg()) : false;
	}

	allBtnsOpenLiveChat(openLiveChatBtn);
	allBtnsOpenLiveChat(openLiveChatConsult);
	allBtnsOpenLiveChat(openLiveChatHelpDoc);

	const switchContainerTable = document.querySelector('.switch>input');
	const containerTable = document.querySelector('.methods_container');

	if (switchContainerTable !== null) {
		switchContainerTable.addEventListener('click', () => {
			containerTable.classList.toggle('methods_deposit');
		});
	}

	liceance();
	popUp();
	legalDocumentsTabs();
});

jQuery('.accordion-box').click(function (){
	jQuery(this).find('.address__text').fadeToggle()
})

// const accordionToggle = document.querySelectorAll('.accordion-box');
// accordionToggle.forEach((itemElem) => {
// 	itemElem.addEventListener('click', () => {
// 		itemElem.classList.toggle('text-hidden');
// 	});
// });

function liceance() {
	const honorfxMU = 'mu';
	const honorfxMY = 'my';
	const sitesWrappList = document.querySelector('.header_logo_wrapp');
	const siteLinks = document.querySelectorAll('.show-sites__item');
	const currentSiteText = document.querySelector('.current-site');
	const allSitesList = document.querySelector('.show-sites');
	const headerLogoLink = document.querySelector('.header_logo');
	const footerLogoLink = document.querySelector('.footer__logo a');
	const allDemoLink = document.querySelectorAll('a[href="/demo"]');
	const linkBackHome = document.querySelector('.link-back-home');
	const footerMenuLink = document.querySelectorAll('.footer__module-container a');

	let currentLocationStorage = getCookie('currentLocalKey');
	let currentLocation;
	if(siteLinks.length == 0) return;

		switch(window.location.pathname.slice(1,3)){
			case honorfxMU:
				currentLocation = honorfxMU;
				break;
			case honorfxMY:
				currentLocation = honorfxMY;
				break;
			default:
				currentLocation = '';
		}

		currentSiteText.innerText = siteLinks[0].innerText;
		siteLinks.forEach(currLink => {
			!currLink.dataset.site ? currLink.classList.add('show-sites__item--active') : currLink.classList.remove('show-sites__item--active');
			currLink.addEventListener('click', function (e){
					document.cookie = 'currentLocalKey='+ this.getAttribute('data-site')+';path=/;';
			})
		});



		sitesWrappList.addEventListener('click', () => {
			sitesWrappList.classList.toggle('header_logo_wrapp-active');
			allSitesList.classList.toggle('show-sites__active');
			currentSiteText.classList.toggle('current-site__active');
		});

		function menuSitesClose() {
			sitesWrappList.classList.remove('header_logo_wrapp-active');
			allSitesList.classList.remove('show-sites__active');
			currentSiteText.classList.remove('current-site__active');
		}

		function menuSitesCloseClick(e) {
			if (!e.target.matches('.header_logo_wrapp, .current-site, .show-sites *')) {
				menuSitesClose();
			}
		}

		document.addEventListener('click', menuSitesCloseClick);

		console.log(currentLocationStorage )


		if (currentLocationStorage.match(honorfxMU) || currentLocationStorage.match(honorfxMY)) {
			headerLogoLink.href = `/${currentLocation}`;
			footerLogoLink.href = `/${currentLocation}`;
			!linkBackHome ? false : linkBackHome.href = currentLocation;
			for (let linkDemo of allDemoLink) {
				linkDemo.href = `/${currentLocation}/demo`;
			}

			footerMenuLink.forEach((el)=>{
				let elHref = el.getAttribute('href');
				el.setAttribute('href', '/'+currentLocationStorage + elHref);
			})

		}


		if (currentLocationStorage.match(honorfxMU)) {
			siteLinks.forEach(currLink => {
				if (currLink.dataset.site === honorfxMU) {
					currLink.classList.add('show-sites__item--active');
					currentSiteText.innerText = currLink.innerText;
				} else {
					currLink.classList.remove('show-sites__item--active');
				}
			});
		}

		if (currentLocationStorage.match(honorfxMY)) {
			siteLinks.forEach(currLink => {
				if (currLink.dataset.site === honorfxMY) {
					currLink.classList.add('show-sites__item--active');
					currentSiteText.innerText = currLink.innerText;
				} else {
					currLink.classList.remove('show-sites__item--active');
				}
			});
		}
		
};


function getCookie(name) {
	let matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}
function deleteCookie(name) {
	setCookie(name, "", {
		'max-age': -1
	})
}

function popUp() {
	const btnPopUpCloseElem = document.querySelector('.pop-up__close');
	const popUpOverflow = document.querySelector('.pop-up__overflow');

	if (popUpOverflow !== null) {
		const openPopUp = () => {
			popUpOverflow.classList.add('pop-up__active');
			document.addEventListener('keydown', escapeHandler);
		};

		const closePopUp = () => {
			popUpOverflow.classList.remove('pop-up__active');
			document.removeEventListener('keydown', escapeHandler);
		};

		const escapeHandler = e => {
			e.code === 'Escape' ? closePopUp() : false;
		}

		setTimeout(() => {
			openPopUp();
		}, 5000);

		btnPopUpCloseElem.addEventListener('click', () => {
			closePopUp();
		});


		popUpOverflow.addEventListener('click', e => {
			const target = e.target;
			target.classList.contains('pop-up__close') || target === popUpOverflow ? closePopUp() : false;
		});
	}
}

function legalDocumentsTabs() {
	const documentsItemElems = document.querySelectorAll('.documents__item');
	const documentsFilesContainer = document.querySelectorAll('.documents__files-container');

	if (documentsItemElems.length !== 3 && documentsFilesContainer.length !== 3) return;

	const removeAllListItems = () => {
		documentsItemElems.forEach(elem => elem.classList.remove('documents__item--active'));
		documentsFilesContainer.forEach(elem => elem.classList.remove('documents__files-active'));
	};

	const checkedFileLicense = (license) => {
		const licenseName = license.innerText;

		if (licenseName.match('Malaysia')) {
			documentsFilesContainer[0].classList.add('documents__files-active');
		} else if (licenseName.match('Mauritius')) {
			documentsFilesContainer[1].classList.add('documents__files-active');
		} else if (licenseName.match('St. Vincent')) {
			documentsFilesContainer[2].classList.add('documents__files-active');
		}
	};

	documentsItemElems.forEach((listElem, i) => {
		listElem.addEventListener('click', () => {
			if (!listElem.classList.contains('documents__item--active')) {
				removeAllListItems();
				listElem.classList.add('documents__item--active');
			}
			checkedFileLicense(listElem);
		});
	});
}