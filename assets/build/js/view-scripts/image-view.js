(()=>{"use strict";var e={n:t=>{var r=t&&t.__esModule?()=>t.default:()=>t;return e.d(r,{a:r}),r},d:(t,r)=>{for(var o in r)e.o(r,o)&&!e.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:r[o]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.domReady;e.n(t)()((function(){window.addEventListener("DOMContentLoaded",(()=>{if("loading"in HTMLImageElement.prototype)return void document.querySelectorAll('[data-lazy-load="true"]').forEach((e=>{e.src=e.dataset.src}));const e=new IntersectionObserver((t=>{t.forEach((t=>{t.isIntersecting&&(t.target.src=t.target.dataset.src,e.unobserve(t.target))}))}));document.querySelectorAll('[data-lazy-load="true"]').forEach((t=>{e.observe(t)}))}))}))})();