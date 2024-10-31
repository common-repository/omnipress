import { getContext, getElement, store } from '@wordpress/interactivity';

const STYLES = {
	active: `
		max-height: 100vh;
		opacity: 1;
		pointer-events: auto;
		transform: translate(0, 0);
		transition: transform 500ms ease-in;
		z-index: 99999;
	`,
	close: `
		transform: translate(-100%);
		transition: transform 500ms ease-in;
		height: 0;
	`,
};

const setCookie = (name, value, days) => {
	const expires = new Date(
		Date.now() + days * 24 * 60 * 60 * 1000
	).toUTCString();
	document.cookie = `${name}=${value};expires=${expires};path=/`;
};

const getCookie = name => {
	const nameEQ = `${name}=`;
	return (
		document.cookie
			.split(';')
			.find(cookie => cookie.trim().startsWith(nameEQ))
			?.substring(nameEQ.length) || null
	);
};

const updatePopupDisplayCount = (instanceId, repetition) => {
	if (repetition === -1) return;

	const count =
		parseInt(
			getCookie(`omnipress_popup_display_count_${instanceId}`),
			10
		) || 0;
	setCookie(`omnipress_popup_display_count_${instanceId}`, count + 1, 7);
};

const removeElement = (element, instanceId, repetition) => {
	updatePopupDisplayCount(instanceId, repetition);
	setTimeout(() => element?.parentElement?.remove(), 600);
};

const initiateInactivityListener = (callback, idleTime = 3) => {
	const idleDuration = idleTime * 1000;
	let timer;

	const resetTimer = () => {
		clearTimeout(timer);
		timer = setTimeout(callback, idleDuration);
	};

	['load', 'mousemove', 'keypress'].forEach(event =>
		window.addEventListener(event, resetTimer)
	);
};

const closePopup = context => {
	if (!context.popupEl) return;

	context.popupEl.style.cssText = STYLES.close;
	removeElement(
		context.popupEl,
		context.instanceId,
		context.popup_repetition
	);
	context.isOpened = false;
};

const togglePopup = function () {
	if (!this || (this.close_button_delay > 0 && this.isOpened)) return;

	const { popupEl, auto_close_delay } = this;
	popupEl.style.cssText = this.isOpened ? STYLES.close : STYLES.active;

	if (auto_close_delay) {
		setTimeout(() => closePopup(this), auto_close_delay * 1000);
	}

	startCloseTimer(this);

	if (!this.is_dismissible) {
		attachCloseOnClick(this);
	}

	this.isOpened = !this.isOpened;
};

const startCloseTimer = context => {
	if (context.close_button_delay <= 0) return;

	const interval = setInterval(() => {
		context.close_button_delay--;
		if (context.close_button_delay <= 0) {
			clearInterval(interval);
			context.close_button_delay = 'Close';
			context.button_style = 'padding:8px;background:#fff';
		}
	}, 1000);
};

const openPopup = context => {
	if (!context || !context.popupEl) return;

	context.isOpened = true;
	context.popupEl.style.cssText = STYLES.active;

	if (context.auto_close_delay) {
		setTimeout(() => closePopup(context), context.auto_close_delay * 1000);
	}

	startCloseTimer(context);

	if (!context.is_dismissible) {
		attachCloseOnClick(context);
	}
};

const handlePopupTrigger = function () {
	const { popup_triggered, time_delay } = this;

	switch (popup_triggered) {
		case 'on_page_load':
			setTimeout(() => openPopup(this), time_delay * 1000);
			break;

		case 'on_exit_intend':
			window.addEventListener('mouseout', e => {
				if (e.clientY <= 0) openPopup(this);
			});
			break;

		case 'on_inactivity':
			initiateInactivityListener(() => openPopup(this));
			break;

		case 'on_scroll':
			const checkScrollPosition = () => {
				const { scrollTop, scrollHeight } = document.documentElement;
				const viewportHeight = window.innerHeight;
				const scrolledPercentage =
					(scrollTop / (scrollHeight - viewportHeight)) * 100;

				if (scrolledPercentage >= time_delay) {
					openPopup(this);
					window.removeEventListener('scroll', checkScrollPosition);
				}
			};
			window.addEventListener('scroll', checkScrollPosition);
			break;
	}
};

const attachCloseOnClick = context => {
	if (!context) return;

	document
		.querySelectorAll(`.opcpop-${context.instanceId}`)
		.forEach(closeBtn => {
			closeBtn.addEventListener('click', () => closePopup(context));
		});
};

const { state, actions, callbacks } = store('omnipress/popup', {
	actions: {
		closeModal: e => {
			const context = getContext();
			if (context.close_button_delay > 0) return;

			e.stopPropagation();
			closePopup(context);
		},
		closePopup: () => closePopup(getContext()),
	},
	callbacks: {
		onTriggeredPopup: e => {
			const context = getContext();
			context.popupEl = getElement().ref;

			if (context.popup_triggered === 'on_click') {
				document
					.querySelectorAll(`.optpop-${context.instanceId}`)
					.forEach(btn => {
						btn.addEventListener(
							'click',
							togglePopup.bind(context)
						);
					});
			} else {
				handlePopupTrigger.call(context);
			}
		},
	},
});
