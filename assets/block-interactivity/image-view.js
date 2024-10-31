import { getContext, getElement, store } from "@wordpress/interactivity";

let imageRef;
const { state, actions, callbacks } = store(
	"omnipress/image",
	{
		state: {
			lightbox: {
				ref: null,
			},
			currentImage: {
				src: "",
				alt: "",
			},
		},
		actions: {
			showLightbox: () => {
				const ref = getElement();
				const context = getContext();
				imageRef = ref;

				state.currentImage.src = context.src;
				state.currentImage.alt = context.alt;
				state.currentImage.style = `opacity:1; pointer-events:all;`;
			},

			hideLightbox: () => {
				state.currentImage.src = "";
				state.currentImage.alt = "";
				state.currentImage.style = `opacity:0; pointer-events:none;`;
			},
		},
		callbacks: {
			setImageStyles: () => {
				const ref = getElement();
				imageRef = ref;

				// lazy load
				const isSupportLazyLoad =
					"loading" in HTMLImageElement.prototype;

				if (isSupportLazyLoad) {
					document
						.querySelectorAll('[data-lazy-load="true"]')
						.forEach((el) => {
							el.src = el.dataset.src;
						});
					return;
				}

				const observer = new IntersectionObserver((entries) => {
					entries.forEach((entry) => {
						if (entry.isIntersecting) {
							entry.target.src = entry.target.dataset.src;
							observer.unobserve(entry.target);
						}
					});
				});
				observer.observe(ref);

				ref.style = "cursor:zoom";
			},
		},
	},
	{ lock: true },
);
