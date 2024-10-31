import { getContext, getElement, store } from '@wordpress/interactivity';

store('omnipress/slider', {
	actions: {},
	callbacks: {
		init: () => {
			const context = getContext();

			let ref = getElement().ref;

			if (context.swiperEl) {
				let swiperEl = document.querySelector(context.swiperEl);

				ref = context.swiperEl;
			}
			const {
				// loop,
				// autoplay,
				// delay,
				// speed,
				// effect,
				// slierPerView,
				// spaceBetween,
				// breakpoints,
				navigation,
				pagination,
			} = context;

			const swiper = new Swiper(ref, {
				...context,
			});
		},
	},
});
