(()=>{"use strict";var e={n:t=>{var o=t&&t.__esModule?()=>t.default:()=>t;return e.d(o,{a:o}),o},d:(t,o)=>{for(var n in o)e.o(o,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:o[n]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.apiFetch;var o=e.n(t);document.querySelectorAll(".op-megamenu__list.has-dropdown .op-megamenu__dropdown > .op-megamenu__dropdown-content").forEach((async e=>{const t=e.dataset.menuid;try{const n=(await o()({path:`/wp/v2/op-menu-templates/${t}`})).content.rendered;n&&e.insertAdjacentHTML("afterend",n)}catch(e){console.error(e)}}))})();