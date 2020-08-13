(function () {

	document.addEventListener("DOMContentLoaded", function(){
		if(document.querySelector('.aio-contact-trigger')) {
			aioInitialize()
		}
	})
	
	function aioInitialize() {
		document.querySelector('.aio-contact-trigger').addEventListener('click', () => {
			document.querySelector('.aio-contact-trigger').classList.toggle('open')
			document.querySelector('.aio-contact-floating').classList.toggle('open')
		})
		let items = document.querySelectorAll('.aio-contact-items > div')
		items.forEach(item => {
			item.addEventListener('click', () => {
				if(item.dataset.url) {
					openUrl(item.dataset.url)
				} else {
					alert('URL Missing')
				}
			})
		})
	}

})()