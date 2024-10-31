/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../omnipress-pro/node_modules/@preact/signals-core/dist/signals-core.module.js":
/*!**************************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@preact/signals-core/dist/signals-core.module.js ***!
  \**************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Signal: () => (/* binding */ u),
/* harmony export */   batch: () => (/* binding */ r),
/* harmony export */   computed: () => (/* binding */ w),
/* harmony export */   effect: () => (/* binding */ E),
/* harmony export */   signal: () => (/* binding */ d),
/* harmony export */   untracked: () => (/* binding */ n)
/* harmony export */ });
var i=Symbol.for("preact-signals");function t(){if(!(s>1)){var i,t=!1;while(void 0!==h){var r=h;h=void 0;f++;while(void 0!==r){var o=r.o;r.o=void 0;r.f&=-3;if(!(8&r.f)&&c(r))try{r.c()}catch(r){if(!t){i=r;t=!0}}r=o}}f=0;s--;if(t)throw i}else s--}function r(i){if(s>0)return i();s++;try{return i()}finally{t()}}var o=void 0;function n(i){var t=o;o=void 0;try{return i()}finally{o=t}}var h=void 0,s=0,f=0,v=0;function e(i){if(void 0!==o){var t=i.n;if(void 0===t||t.t!==o){t={i:0,S:i,p:o.s,n:void 0,t:o,e:void 0,x:void 0,r:t};if(void 0!==o.s)o.s.n=t;o.s=t;i.n=t;if(32&o.f)i.S(t);return t}else if(-1===t.i){t.i=0;if(void 0!==t.n){t.n.p=t.p;if(void 0!==t.p)t.p.n=t.n;t.p=o.s;t.n=void 0;o.s.n=t;o.s=t}return t}}}function u(i){this.v=i;this.i=0;this.n=void 0;this.t=void 0}u.prototype.brand=i;u.prototype.h=function(){return!0};u.prototype.S=function(i){if(this.t!==i&&void 0===i.e){i.x=this.t;if(void 0!==this.t)this.t.e=i;this.t=i}};u.prototype.U=function(i){if(void 0!==this.t){var t=i.e,r=i.x;if(void 0!==t){t.x=r;i.e=void 0}if(void 0!==r){r.e=t;i.x=void 0}if(i===this.t)this.t=r}};u.prototype.subscribe=function(i){var t=this;return E(function(){var r=t.value,n=o;o=void 0;try{i(r)}finally{o=n}})};u.prototype.valueOf=function(){return this.value};u.prototype.toString=function(){return this.value+""};u.prototype.toJSON=function(){return this.value};u.prototype.peek=function(){var i=o;o=void 0;try{return this.value}finally{o=i}};Object.defineProperty(u.prototype,"value",{get:function(){var i=e(this);if(void 0!==i)i.i=this.i;return this.v},set:function(i){if(i!==this.v){if(f>100)throw new Error("Cycle detected");this.v=i;this.i++;v++;s++;try{for(var r=this.t;void 0!==r;r=r.x)r.t.N()}finally{t()}}}});function d(i){return new u(i)}function c(i){for(var t=i.s;void 0!==t;t=t.n)if(t.S.i!==t.i||!t.S.h()||t.S.i!==t.i)return!0;return!1}function a(i){for(var t=i.s;void 0!==t;t=t.n){var r=t.S.n;if(void 0!==r)t.r=r;t.S.n=t;t.i=-1;if(void 0===t.n){i.s=t;break}}}function l(i){var t=i.s,r=void 0;while(void 0!==t){var o=t.p;if(-1===t.i){t.S.U(t);if(void 0!==o)o.n=t.n;if(void 0!==t.n)t.n.p=o}else r=t;t.S.n=t.r;if(void 0!==t.r)t.r=void 0;t=o}i.s=r}function y(i){u.call(this,void 0);this.x=i;this.s=void 0;this.g=v-1;this.f=4}(y.prototype=new u).h=function(){this.f&=-3;if(1&this.f)return!1;if(32==(36&this.f))return!0;this.f&=-5;if(this.g===v)return!0;this.g=v;this.f|=1;if(this.i>0&&!c(this)){this.f&=-2;return!0}var i=o;try{a(this);o=this;var t=this.x();if(16&this.f||this.v!==t||0===this.i){this.v=t;this.f&=-17;this.i++}}catch(i){this.v=i;this.f|=16;this.i++}o=i;l(this);this.f&=-2;return!0};y.prototype.S=function(i){if(void 0===this.t){this.f|=36;for(var t=this.s;void 0!==t;t=t.n)t.S.S(t)}u.prototype.S.call(this,i)};y.prototype.U=function(i){if(void 0!==this.t){u.prototype.U.call(this,i);if(void 0===this.t){this.f&=-33;for(var t=this.s;void 0!==t;t=t.n)t.S.U(t)}}};y.prototype.N=function(){if(!(2&this.f)){this.f|=6;for(var i=this.t;void 0!==i;i=i.x)i.t.N()}};Object.defineProperty(y.prototype,"value",{get:function(){if(1&this.f)throw new Error("Cycle detected");var i=e(this);this.h();if(void 0!==i)i.i=this.i;if(16&this.f)throw this.v;return this.v}});function w(i){return new y(i)}function _(i){var r=i.u;i.u=void 0;if("function"==typeof r){s++;var n=o;o=void 0;try{r()}catch(t){i.f&=-2;i.f|=8;g(i);throw t}finally{o=n;t()}}}function g(i){for(var t=i.s;void 0!==t;t=t.n)t.S.U(t);i.x=void 0;i.s=void 0;_(i)}function p(i){if(o!==this)throw new Error("Out-of-order effect");l(this);o=i;this.f&=-2;if(8&this.f)g(this);t()}function b(i){this.x=i;this.u=void 0;this.s=void 0;this.o=void 0;this.f=32}b.prototype.c=function(){var i=this.S();try{if(8&this.f)return;if(void 0===this.x)return;var t=this.x();if("function"==typeof t)this.u=t}finally{i()}};b.prototype.S=function(){if(1&this.f)throw new Error("Cycle detected");this.f|=1;this.f&=-9;_(this);a(this);s++;var i=o;o=this;return p.bind(this,i)};b.prototype.N=function(){if(!(2&this.f)){this.f|=2;this.o=h;h=this}};b.prototype.d=function(){this.f|=8;if(!(1&this.f))g(this)};function E(i){var t=new b(i);try{t.c()}catch(i){t.d();throw i}return t.d.bind(t)}//# sourceMappingURL=signals-core.module.js.map


/***/ }),

/***/ "../omnipress-pro/node_modules/@preact/signals/dist/signals.module.js":
/*!****************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@preact/signals/dist/signals.module.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Signal: () => (/* reexport safe */ _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.Signal),
/* harmony export */   batch: () => (/* reexport safe */ _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.batch),
/* harmony export */   computed: () => (/* reexport safe */ _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.computed),
/* harmony export */   effect: () => (/* reexport safe */ _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.effect),
/* harmony export */   signal: () => (/* reexport safe */ _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.signal),
/* harmony export */   untracked: () => (/* reexport safe */ _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.untracked),
/* harmony export */   useComputed: () => (/* binding */ useComputed),
/* harmony export */   useSignal: () => (/* binding */ useSignal),
/* harmony export */   useSignalEffect: () => (/* binding */ useSignalEffect)
/* harmony export */ });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "../omnipress-pro/node_modules/preact/dist/preact.module.js");
/* harmony import */ var preact_hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! preact/hooks */ "../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js");
/* harmony import */ var _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @preact/signals-core */ "../omnipress-pro/node_modules/@preact/signals-core/dist/signals-core.module.js");
var v,s;function l(n,i){preact__WEBPACK_IMPORTED_MODULE_0__.options[n]=i.bind(null,preact__WEBPACK_IMPORTED_MODULE_0__.options[n]||function(){})}function d(n){if(s)s();s=n&&n.S()}function p(n){var r=this,f=n.data,o=useSignal(f);o.value=f;var e=(0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useMemo)(function(){var n=r.__v;while(n=n.__)if(n.__c){n.__c.__$f|=4;break}r.__$u.c=function(){var n;if(!(0,preact__WEBPACK_IMPORTED_MODULE_0__.isValidElement)(e.peek())&&3===(null==(n=r.base)?void 0:n.nodeType))r.base.data=e.peek();else{r.__$f|=1;r.setState({})}};return (0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.computed)(function(){var n=o.value.value;return 0===n?0:!0===n?"":n||""})},[]);return e.value}p.displayName="_st";Object.defineProperties(_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.Signal.prototype,{constructor:{configurable:!0,value:void 0},type:{configurable:!0,value:p},props:{configurable:!0,get:function(){return{data:this}}},__b:{configurable:!0,value:1}});l("__b",function(n,r){if("string"==typeof r.type){var i,t=r.props;for(var f in t)if("children"!==f){var o=t[f];if(o instanceof _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.Signal){if(!i)r.__np=i={};i[f]=o;t[f]=o.peek()}}}n(r)});l("__r",function(n,r){d();var i,t=r.__c;if(t){t.__$f&=-2;if(void 0===(i=t.__$u))t.__$u=i=function(n){var r;(0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.effect)(function(){r=this});r.c=function(){t.__$f|=1;t.setState({})};return r}()}v=t;d(i);n(r)});l("__e",function(n,r,i,t){d();v=void 0;n(r,i,t)});l("diffed",function(n,r){d();v=void 0;var i;if("string"==typeof r.type&&(i=r.__e)){var t=r.__np,f=r.props;if(t){var o=i.U;if(o)for(var e in o){var u=o[e];if(void 0!==u&&!(e in t)){u.d();o[e]=void 0}}else i.U=o={};for(var a in t){var c=o[a],s=t[a];if(void 0===c){c=_(i,a,s,f);o[a]=c}else c.o(s,f)}}}n(r)});function _(n,r,i,t){var f=r in n&&void 0===n.ownerSVGElement,o=(0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.signal)(i);return{o:function(n,r){o.value=n;t=r},d:(0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.effect)(function(){var i=o.value.value;if(t[r]!==i){t[r]=i;if(f)n[r]=i;else if(i)n.setAttribute(r,i);else n.removeAttribute(r)}})}}l("unmount",function(n,r){if("string"==typeof r.type){var i=r.__e;if(i){var t=i.U;if(t){i.U=void 0;for(var f in t){var o=t[f];if(o)o.d()}}}}else{var e=r.__c;if(e){var u=e.__$u;if(u){e.__$u=void 0;u.d()}}}n(r)});l("__h",function(n,r,i,t){if(t<3||9===t)r.__$f|=2;n(r,i,t)});preact__WEBPACK_IMPORTED_MODULE_0__.Component.prototype.shouldComponentUpdate=function(n,r){var i=this.__$u;if(!(i&&void 0!==i.s||4&this.__$f))return!0;if(3&this.__$f)return!0;for(var t in r)return!0;for(var f in n)if("__source"!==f&&n[f]!==this.props[f])return!0;for(var o in this.props)if(!(o in n))return!0;return!1};function useSignal(n){return (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useMemo)(function(){return (0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.signal)(n)},[])}function useComputed(n){var r=(0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useRef)(n);r.current=n;v.__$f|=4;return (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useMemo)(function(){return (0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.computed)(function(){return r.current()})},[])}function useSignalEffect(n){var r=(0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useRef)(n);r.current=n;(0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useEffect)(function(){return (0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.effect)(function(){return r.current()})},[])}//# sourceMappingURL=signals.module.js.map


/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/constants.js":
/*!****************************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/constants.js ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   directivePrefix: () => (/* binding */ directivePrefix)
/* harmony export */ });
const directivePrefix = 'wp';
//# sourceMappingURL=constants.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/directives.js":
/*!*****************************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/directives.js ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "../omnipress-pro/node_modules/preact/dist/preact.module.js");
/* harmony import */ var preact_hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! preact/hooks */ "../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js");
/* harmony import */ var deepsignal__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! deepsignal */ "../omnipress-pro/node_modules/deepsignal/dist/deepsignal.module.js");
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./utils */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/utils.js");
/* harmony import */ var _hooks__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./hooks */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/hooks.js");
// eslint-disable-next-line eslint-comments/disable-enable-pair
/* eslint-disable react-hooks/exhaustive-deps */

/**
 * External dependencies
 */




/**
 * Internal dependencies
 */



// Assigned objects should be ignored during proxification.
const contextAssignedObjects = new WeakMap();

// Store the context proxy and fallback for each object in the context.
const contextObjectToProxy = new WeakMap();
const contextProxyToObject = new WeakMap();
const contextObjectToFallback = new WeakMap();
const isPlainObject = item => Boolean(item && typeof item === 'object' && item.constructor === Object);
const descriptor = Reflect.getOwnPropertyDescriptor;

/**
 * Wrap a context object with a proxy to reproduce the context stack. The proxy
 * uses the passed `inherited` context as a fallback to look up for properties
 * that don't exist in the given context. Also, updated properties are modified
 * where they are defined, or added to the main context when they don't exist.
 *
 * By default, all plain objects inside the context are wrapped, unless it is
 * listed in the `ignore` option.
 *
 * @param current   Current context.
 * @param inherited Inherited context, used as fallback.
 *
 * @return The wrapped context object.
 */
const proxifyContext = (current, inherited = {}) => {
  // Update the fallback object reference when it changes.
  contextObjectToFallback.set(current, inherited);
  if (!contextObjectToProxy.has(current)) {
    const proxy = new Proxy(current, {
      get: (target, k) => {
        const fallback = contextObjectToFallback.get(current);
        // Always subscribe to prop changes in the current context.
        const currentProp = target[k];

        // Return the inherited prop when missing in target.
        if (!(k in target) && k in fallback) {
          return fallback[k];
        }

        // Proxify plain objects that were not directly assigned.
        if (k in target && !contextAssignedObjects.get(target)?.has(k) && isPlainObject((0,deepsignal__WEBPACK_IMPORTED_MODULE_4__.peek)(target, k))) {
          return proxifyContext(currentProp, fallback[k]);
        }

        // Return the stored proxy for `currentProp` when it exists.
        if (contextObjectToProxy.has(currentProp)) {
          return contextObjectToProxy.get(currentProp);
        }

        /*
         * For other cases, return the value from target, also
         * subscribing to changes in the parent context when the current
         * prop is not defined.
         */
        return k in target ? currentProp : fallback[k];
      },
      set: (target, k, value) => {
        const fallback = contextObjectToFallback.get(current);
        const obj = k in target || !(k in fallback) ? target : fallback;

        /*
         * Assigned object values should not be proxified so they point
         * to the original object and don't inherit unexpected
         * properties.
         */
        if (value && typeof value === 'object') {
          if (!contextAssignedObjects.has(obj)) {
            contextAssignedObjects.set(obj, new Set());
          }
          contextAssignedObjects.get(obj).add(k);
        }

        /*
         * When the value is a proxy, it's because it comes from the
         * context, so the inner value is assigned instead.
         */
        if (contextProxyToObject.has(value)) {
          const innerValue = contextProxyToObject.get(value);
          obj[k] = innerValue;
        } else {
          obj[k] = value;
        }
        return true;
      },
      ownKeys: target => [...new Set([...Object.keys(contextObjectToFallback.get(current)), ...Object.keys(target)])],
      getOwnPropertyDescriptor: (target, k) => descriptor(target, k) || descriptor(contextObjectToFallback.get(current), k)
    });
    contextObjectToProxy.set(current, proxy);
    contextProxyToObject.set(proxy, current);
  }
  return contextObjectToProxy.get(current);
};

/**
 * Recursively update values within a deepSignal object.
 *
 * @param target A deepSignal instance.
 * @param source Object with properties to update in `target`.
 */
const updateSignals = (target, source) => {
  for (const k in source) {
    if (isPlainObject((0,deepsignal__WEBPACK_IMPORTED_MODULE_4__.peek)(target, k)) && isPlainObject((0,deepsignal__WEBPACK_IMPORTED_MODULE_4__.peek)(source, k))) {
      updateSignals(target[`$${k}`].peek(), source[k]);
    } else {
      target[k] = source[k];
    }
  }
};

/**
 * Recursively clone the passed object.
 *
 * @param source Source object.
 * @return Cloned object.
 */
function deepClone(source) {
  if (isPlainObject(source)) {
    return Object.fromEntries(Object.entries(source).map(([key, value]) => [key, deepClone(value)]));
  }
  if (Array.isArray(source)) {
    return source.map(i => deepClone(i));
  }
  return source;
}
const newRule = /(?:([\u0080-\uFFFF\w-%@]+) *:? *([^{;]+?);|([^;}{]*?) *{)|(}\s*)/g;
const ruleClean = /\/\*[^]*?\*\/|  +/g;
const ruleNewline = /\n+/g;
const empty = ' ';

/**
 * Convert a css style string into a object.
 *
 * Made by Cristian Bote (@cristianbote) for Goober.
 * https://unpkg.com/browse/goober@2.1.13/src/core/astish.js
 *
 * @param val CSS string.
 * @return CSS object.
 */
const cssStringToObject = val => {
  const tree = [{}];
  let block, left;
  while (block = newRule.exec(val.replace(ruleClean, ''))) {
    if (block[4]) {
      tree.shift();
    } else if (block[3]) {
      left = block[3].replace(ruleNewline, empty).trim();
      tree.unshift(tree[0][left] = tree[0][left] || {});
    } else {
      tree[0][block[1]] = block[2].replace(ruleNewline, empty).trim();
    }
  }
  return tree[0];
};

/**
 * Creates a directive that adds an event listener to the global window or
 * document object.
 *
 * @param type 'window' or 'document'
 */
const getGlobalEventDirective = type => {
  return ({
    directives,
    evaluate
  }) => {
    directives[`on-${type}`].filter(({
      suffix
    }) => suffix !== 'default').forEach(entry => {
      const eventName = entry.suffix.split('--', 1)[0];
      (0,_utils__WEBPACK_IMPORTED_MODULE_2__.useInit)(() => {
        const cb = event => evaluate(entry, event);
        const globalVar = type === 'window' ? window : document;
        globalVar.addEventListener(eventName, cb);
        return () => globalVar.removeEventListener(eventName, cb);
      });
    });
  };
};

/**
 * Creates a directive that adds an async event listener to the global window or
 * document object.
 *
 * @param type 'window' or 'document'
 */
const getGlobalAsyncEventDirective = type => {
  return ({
    directives,
    evaluate
  }) => {
    directives[`on-async-${type}`].filter(({
      suffix
    }) => suffix !== 'default').forEach(entry => {
      const eventName = entry.suffix.split('--', 1)[0];
      (0,_utils__WEBPACK_IMPORTED_MODULE_2__.useInit)(() => {
        const cb = async event => {
          await (0,_utils__WEBPACK_IMPORTED_MODULE_2__.splitTask)();
          evaluate(entry, event);
        };
        const globalVar = type === 'window' ? window : document;
        globalVar.addEventListener(eventName, cb, {
          passive: true
        });
        return () => globalVar.removeEventListener(eventName, cb);
      });
    });
  };
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (() => {
  // data-wp-context
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('context',
  // @ts-ignore-next-line
  ({
    directives: {
      context
    },
    props: {
      children
    },
    context: inheritedContext
  }) => {
    const {
      Provider
    } = inheritedContext;
    const inheritedValue = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useContext)(inheritedContext);
    const currentValue = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useRef)((0,deepsignal__WEBPACK_IMPORTED_MODULE_4__.deepSignal)({}));
    const defaultEntry = context.find(({
      suffix
    }) => suffix === 'default');

    // No change should be made if `defaultEntry` does not exist.
    const contextStack = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useMemo)(() => {
      if (defaultEntry) {
        const {
          namespace,
          value
        } = defaultEntry;
        // Check that the value is a JSON object. Send a console warning if not.
        if (!isPlainObject(value)) {
          (0,_utils__WEBPACK_IMPORTED_MODULE_2__.warn)(`The value of data-wp-context in "${namespace}" store must be a valid stringified JSON object.`);
        }
        updateSignals(currentValue.current, {
          [namespace]: deepClone(value)
        });
      }
      return proxifyContext(currentValue.current, inheritedValue);
    }, [defaultEntry, inheritedValue]);
    return (0,preact__WEBPACK_IMPORTED_MODULE_0__.h)(Provider, {
      value: contextStack
    }, children);
  }, {
    priority: 5
  });

  // data-wp-watch--[name]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('watch', ({
    directives: {
      watch
    },
    evaluate
  }) => {
    watch.forEach(entry => {
      (0,_utils__WEBPACK_IMPORTED_MODULE_2__.useWatch)(() => evaluate(entry));
    });
  });

  // data-wp-init--[name]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('init', ({
    directives: {
      init
    },
    evaluate
  }) => {
    init.forEach(entry => {
      // TODO: Replace with useEffect to prevent unneeded scopes.
      (0,_utils__WEBPACK_IMPORTED_MODULE_2__.useInit)(() => evaluate(entry));
    });
  });

  // data-wp-on--[event]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('on', ({
    directives: {
      on
    },
    element,
    evaluate
  }) => {
    const events = new Map();
    on.filter(({
      suffix
    }) => suffix !== 'default').forEach(entry => {
      const event = entry.suffix.split('--')[0];
      if (!events.has(event)) {
        events.set(event, new Set());
      }
      events.get(event).add(entry);
    });
    events.forEach((entries, eventType) => {
      const existingHandler = element.props[`on${eventType}`];
      element.props[`on${eventType}`] = event => {
        entries.forEach(entry => {
          if (existingHandler) {
            existingHandler(event);
          }
          evaluate(entry, event);
        });
      };
    });
  });

  // data-wp-on-async--[event]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('on-async', ({
    directives: {
      'on-async': onAsync
    },
    element,
    evaluate
  }) => {
    const events = new Map();
    onAsync.filter(({
      suffix
    }) => suffix !== 'default').forEach(entry => {
      const event = entry.suffix.split('--')[0];
      if (!events.has(event)) {
        events.set(event, new Set());
      }
      events.get(event).add(entry);
    });
    events.forEach((entries, eventType) => {
      const existingHandler = element.props[`on${eventType}`];
      element.props[`on${eventType}`] = event => {
        if (existingHandler) {
          existingHandler(event);
        }
        entries.forEach(async entry => {
          await (0,_utils__WEBPACK_IMPORTED_MODULE_2__.splitTask)();
          evaluate(entry, event);
        });
      };
    });
  });

  // data-wp-on-window--[event]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('on-window', getGlobalEventDirective('window'));
  // data-wp-on-document--[event]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('on-document', getGlobalEventDirective('document'));

  // data-wp-on-async-window--[event]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('on-async-window', getGlobalAsyncEventDirective('window'));
  // data-wp-on-async-document--[event]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('on-async-document', getGlobalAsyncEventDirective('document'));

  // data-wp-class--[classname]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('class', ({
    directives: {
      class: classNames
    },
    element,
    evaluate
  }) => {
    classNames.filter(({
      suffix
    }) => suffix !== 'default').forEach(entry => {
      const className = entry.suffix;
      const result = evaluate(entry);
      const currentClass = element.props.class || '';
      const classFinder = new RegExp(`(^|\\s)${className}(\\s|$)`, 'g');
      if (!result) {
        element.props.class = currentClass.replace(classFinder, ' ').trim();
      } else if (!classFinder.test(currentClass)) {
        element.props.class = currentClass ? `${currentClass} ${className}` : className;
      }
      (0,_utils__WEBPACK_IMPORTED_MODULE_2__.useInit)(() => {
        /*
         * This seems necessary because Preact doesn't change the class
         * names on the hydration, so we have to do it manually. It doesn't
         * need deps because it only needs to do it the first time.
         */
        if (!result) {
          element.ref.current.classList.remove(className);
        } else {
          element.ref.current.classList.add(className);
        }
      });
    });
  });

  // data-wp-style--[style-prop]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('style', ({
    directives: {
      style
    },
    element,
    evaluate
  }) => {
    style.filter(({
      suffix
    }) => suffix !== 'default').forEach(entry => {
      const styleProp = entry.suffix;
      const result = evaluate(entry);
      element.props.style = element.props.style || {};
      if (typeof element.props.style === 'string') {
        element.props.style = cssStringToObject(element.props.style);
      }
      if (!result) {
        delete element.props.style[styleProp];
      } else {
        element.props.style[styleProp] = result;
      }
      (0,_utils__WEBPACK_IMPORTED_MODULE_2__.useInit)(() => {
        /*
         * This seems necessary because Preact doesn't change the styles on
         * the hydration, so we have to do it manually. It doesn't need deps
         * because it only needs to do it the first time.
         */
        if (!result) {
          element.ref.current.style.removeProperty(styleProp);
        } else {
          element.ref.current.style[styleProp] = result;
        }
      });
    });
  });

  // data-wp-bind--[attribute]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('bind', ({
    directives: {
      bind
    },
    element,
    evaluate
  }) => {
    bind.filter(({
      suffix
    }) => suffix !== 'default').forEach(entry => {
      const attribute = entry.suffix;
      const result = evaluate(entry);
      element.props[attribute] = result;

      /*
       * This is necessary because Preact doesn't change the attributes on the
       * hydration, so we have to do it manually. It only needs to do it the
       * first time. After that, Preact will handle the changes.
       */
      (0,_utils__WEBPACK_IMPORTED_MODULE_2__.useInit)(() => {
        const el = element.ref.current;

        /*
         * We set the value directly to the corresponding HTMLElement instance
         * property excluding the following special cases. We follow Preact's
         * logic: https://github.com/preactjs/preact/blob/ea49f7a0f9d1ff2c98c0bdd66aa0cbc583055246/src/diff/props.js#L110-L129
         */
        if (attribute === 'style') {
          if (typeof result === 'string') {
            el.style.cssText = result;
          }
          return;
        } else if (attribute !== 'width' && attribute !== 'height' && attribute !== 'href' && attribute !== 'list' && attribute !== 'form' &&
        /*
         * The value for `tabindex` follows the parsing rules for an
         * integer. If that fails, or if the attribute isn't present, then
         * the browsers should "follow platform conventions to determine if
         * the element should be considered as a focusable area",
         * practically meaning that most elements get a default of `-1` (not
         * focusable), but several also get a default of `0` (focusable in
         * order after all elements with a positive `tabindex` value).
         *
         * @see https://html.spec.whatwg.org/#tabindex-value
         */
        attribute !== 'tabIndex' && attribute !== 'download' && attribute !== 'rowSpan' && attribute !== 'colSpan' && attribute !== 'role' && attribute in el) {
          try {
            el[attribute] = result === null || result === undefined ? '' : result;
            return;
          } catch (err) {}
        }
        /*
         * aria- and data- attributes have no boolean representation.
         * A `false` value is different from the attribute not being
         * present, so we can't remove it.
         * We follow Preact's logic: https://github.com/preactjs/preact/blob/ea49f7a0f9d1ff2c98c0bdd66aa0cbc583055246/src/diff/props.js#L131C24-L136
         */
        if (result !== null && result !== undefined && (result !== false || attribute[4] === '-')) {
          el.setAttribute(attribute, result);
        } else {
          el.removeAttribute(attribute);
        }
      });
    });
  });

  // data-wp-ignore
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('ignore', ({
    element: {
      type: Type,
      props: {
        innerHTML,
        ...rest
      }
    }
  }) => {
    // Preserve the initial inner HTML.
    const cached = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useMemo)(() => innerHTML, []);
    return (0,preact__WEBPACK_IMPORTED_MODULE_0__.h)(Type, {
      dangerouslySetInnerHTML: {
        __html: cached
      },
      ...rest
    });
  });

  // data-wp-text
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('text', ({
    directives: {
      text
    },
    element,
    evaluate
  }) => {
    const entry = text.find(({
      suffix
    }) => suffix === 'default');
    if (!entry) {
      element.props.children = null;
      return;
    }
    try {
      const result = evaluate(entry);
      element.props.children = typeof result === 'object' ? null : result.toString();
    } catch (e) {
      element.props.children = null;
    }
  });

  // data-wp-run
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('run', ({
    directives: {
      run
    },
    evaluate
  }) => {
    run.forEach(entry => evaluate(entry));
  });

  // data-wp-each--[item]
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('each', ({
    directives: {
      each,
      'each-key': eachKey
    },
    context: inheritedContext,
    element,
    evaluate
  }) => {
    if (element.type !== 'template') {
      return;
    }
    const {
      Provider
    } = inheritedContext;
    const inheritedValue = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useContext)(inheritedContext);
    const [entry] = each;
    const {
      namespace,
      suffix
    } = entry;
    const list = evaluate(entry);
    return list.map(item => {
      const itemProp = suffix === 'default' ? 'item' : (0,_utils__WEBPACK_IMPORTED_MODULE_2__.kebabToCamelCase)(suffix);
      const itemContext = (0,deepsignal__WEBPACK_IMPORTED_MODULE_4__.deepSignal)({
        [namespace]: {}
      });
      const mergedContext = proxifyContext(itemContext, inheritedValue);

      // Set the item after proxifying the context.
      mergedContext[namespace][itemProp] = item;
      const scope = {
        ...(0,_hooks__WEBPACK_IMPORTED_MODULE_3__.getScope)(),
        context: mergedContext
      };
      const key = eachKey ? (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.getEvaluate)({
        scope
      })(eachKey[0]) : item;
      return (0,preact__WEBPACK_IMPORTED_MODULE_0__.h)(Provider, {
        value: mergedContext,
        key
      }, element.props.content);
    });
  }, {
    priority: 20
  });
  (0,_hooks__WEBPACK_IMPORTED_MODULE_3__.directive)('each-child', () => null, {
    priority: 1
  });
});
//# sourceMappingURL=directives.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/hooks.js":
/*!************************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/hooks.js ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   directive: () => (/* binding */ directive),
/* harmony export */   getContext: () => (/* binding */ getContext),
/* harmony export */   getElement: () => (/* binding */ getElement),
/* harmony export */   getEvaluate: () => (/* binding */ getEvaluate),
/* harmony export */   getNamespace: () => (/* binding */ getNamespace),
/* harmony export */   getScope: () => (/* binding */ getScope),
/* harmony export */   resetNamespace: () => (/* binding */ resetNamespace),
/* harmony export */   resetScope: () => (/* binding */ resetScope),
/* harmony export */   setNamespace: () => (/* binding */ setNamespace),
/* harmony export */   setScope: () => (/* binding */ setScope)
/* harmony export */ });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "../omnipress-pro/node_modules/preact/dist/preact.module.js");
/* harmony import */ var preact_hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! preact/hooks */ "../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js");
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./store */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/store.js");
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./utils */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/utils.js");
// eslint-disable-next-line eslint-comments/disable-enable-pair
/* eslint-disable react-hooks/exhaustive-deps */

/**
 * External dependencies
 */


/**
 * Internal dependencies
 */


// Main context.
const context = (0,preact__WEBPACK_IMPORTED_MODULE_0__.createContext)({});

// Wrap the element props to prevent modifications.
const immutableMap = new WeakMap();
const immutableError = () => {
  throw new Error('Please use `data-wp-bind` to modify the attributes of an element.');
};
const immutableHandlers = {
  get(target, key, receiver) {
    const value = Reflect.get(target, key, receiver);
    return !!value && typeof value === 'object' ? deepImmutable(value) : value;
  },
  set: immutableError,
  deleteProperty: immutableError
};
const deepImmutable = target => {
  if (!immutableMap.has(target)) {
    immutableMap.set(target, new Proxy(target, immutableHandlers));
  }
  return immutableMap.get(target);
};

// Store stacks for the current scope and the default namespaces and export APIs
// to interact with them.
const scopeStack = [];
const namespaceStack = [];

/**
 * Retrieves the context inherited by the element evaluating a function from the
 * store. The returned value depends on the element and the namespace where the
 * function calling `getContext()` exists.
 *
 * @param namespace Store namespace. By default, the namespace where the calling
 *                  function exists is used.
 * @return The context content.
 */
const getContext = namespace => getScope()?.context[namespace || getNamespace()];

/**
 * Retrieves a representation of the element where a function from the store
 * is being evalutated. Such representation is read-only, and contains a
 * reference to the DOM element, its props and a local reactive state.
 *
 * @return Element representation.
 */
const getElement = () => {
  if (!getScope()) {
    throw Error('Cannot call `getElement()` outside getters and actions used by directives.');
  }
  const {
    ref,
    attributes
  } = getScope();
  return Object.freeze({
    ref: ref.current,
    attributes: deepImmutable(attributes)
  });
};
const getScope = () => scopeStack.slice(-1)[0];
const setScope = scope => {
  scopeStack.push(scope);
};
const resetScope = () => {
  scopeStack.pop();
};
const getNamespace = () => namespaceStack.slice(-1)[0];
const setNamespace = namespace => {
  namespaceStack.push(namespace);
};
const resetNamespace = () => {
  namespaceStack.pop();
};

// WordPress Directives.
const directiveCallbacks = {};
const directivePriorities = {};

/**
 * Register a new directive type in the Interactivity API runtime.
 *
 * @example
 * ```js
 * directive(
 *   'alert', // Name without the `data-wp-` prefix.
 *   ( { directives: { alert }, element, evaluate } ) => {
 *     const defaultEntry = alert.find( entry => entry.suffix === 'default' );
 *     element.props.onclick = () => { alert( evaluate( defaultEntry ) ); }
 *   }
 * )
 * ```
 *
 * The previous code registers a custom directive type for displaying an alert
 * message whenever an element using it is clicked. The message text is obtained
 * from the store under the inherited namespace, using `evaluate`.
 *
 * When the HTML is processed by the Interactivity API, any element containing
 * the `data-wp-alert` directive will have the `onclick` event handler, e.g.,
 *
 * ```html
 * <div data-wp-interactive="messages">
 *   <button data-wp-alert="state.alert">Click me!</button>
 * </div>
 * ```
 * Note that, in the previous example, the directive callback gets the path
 * value (`state.alert`) from the directive entry with suffix `default`. A
 * custom suffix can also be specified by appending `--` to the directive
 * attribute, followed by the suffix, like in the following HTML snippet:
 *
 * ```html
 * <div data-wp-interactive="myblock">
 *   <button
 *     data-wp-color--text="state.text"
 *     data-wp-color--background="state.background"
 *   >Click me!</button>
 * </div>
 * ```
 *
 * This could be an hypothetical implementation of the custom directive used in
 * the snippet above.
 *
 * @example
 * ```js
 * directive(
 *   'color', // Name without prefix and suffix.
 *   ( { directives: { color: colors }, ref, evaluate } ) =>
 *     colors.forEach( ( color ) => {
 *       if ( color.suffix = 'text' ) {
 *         ref.style.setProperty(
 *           'color',
 *           evaluate( color.text )
 *         );
 *       }
 *       if ( color.suffix = 'background' ) {
 *         ref.style.setProperty(
 *           'background-color',
 *           evaluate( color.background )
 *         );
 *       }
 *     } );
 *   }
 * )
 * ```
 *
 * @param name             Directive name, without the `data-wp-` prefix.
 * @param callback         Function that runs the directive logic.
 * @param options          Options object.
 * @param options.priority Option to control the directive execution order. The
 *                         lesser, the highest priority. Default is `10`.
 */
const directive = (name, callback, {
  priority = 10
} = {}) => {
  directiveCallbacks[name] = callback;
  directivePriorities[name] = priority;
};

// Resolve the path to some property of the store object.
const resolve = (path, namespace) => {
  if (!namespace) {
    (0,_utils__WEBPACK_IMPORTED_MODULE_3__.warn)(`Namespace missing for "${path}". The value for that path won't be resolved.`);
    return;
  }
  let resolvedStore = _store__WEBPACK_IMPORTED_MODULE_2__.stores.get(namespace);
  if (typeof resolvedStore === 'undefined') {
    resolvedStore = (0,_store__WEBPACK_IMPORTED_MODULE_2__.store)(namespace, undefined, {
      lock: _store__WEBPACK_IMPORTED_MODULE_2__.universalUnlock
    });
  }
  const current = {
    ...resolvedStore,
    context: getScope().context[namespace]
  };
  try {
    // TODO: Support lazy/dynamically initialized stores
    return path.split('.').reduce((acc, key) => acc[key], current);
  } catch (e) {}
};

// Generate the evaluate function.
const getEvaluate = ({
  scope
}) => (entry, ...args) => {
  let {
    value: path,
    namespace
  } = entry;
  if (typeof path !== 'string') {
    throw new Error('The `value` prop should be a string path');
  }
  // If path starts with !, remove it and save a flag.
  const hasNegationOperator = path[0] === '!' && !!(path = path.slice(1));
  setScope(scope);
  const value = resolve(path, namespace);
  const result = typeof value === 'function' ? value(...args) : value;
  resetScope();
  return hasNegationOperator ? !result : result;
};

// Separate directives by priority. The resulting array contains objects
// of directives grouped by same priority, and sorted in ascending order.
const getPriorityLevels = directives => {
  const byPriority = Object.keys(directives).reduce((obj, name) => {
    if (directiveCallbacks[name]) {
      const priority = directivePriorities[name];
      (obj[priority] = obj[priority] || []).push(name);
    }
    return obj;
  }, {});
  return Object.entries(byPriority).sort(([p1], [p2]) => parseInt(p1) - parseInt(p2)).map(([, arr]) => arr);
};

// Component that wraps each priority level of directives of an element.
const Directives = ({
  directives,
  priorityLevels: [currentPriorityLevel, ...nextPriorityLevels],
  element,
  originalProps,
  previousScope
}) => {
  // Initialize the scope of this element. These scopes are different per each
  // level because each level has a different context, but they share the same
  // element ref, state and props.
  const scope = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useRef)({}).current;
  scope.evaluate = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useCallback)(getEvaluate({
    scope
  }), []);
  scope.context = (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useContext)(context);
  /* eslint-disable react-hooks/rules-of-hooks */
  scope.ref = previousScope?.ref || (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useRef)(null);
  /* eslint-enable react-hooks/rules-of-hooks */

  // Create a fresh copy of the vnode element and add the props to the scope,
  // named as attributes (HTML Attributes).
  element = (0,preact__WEBPACK_IMPORTED_MODULE_0__.cloneElement)(element, {
    ref: scope.ref
  });
  scope.attributes = element.props;

  // Recursively render the wrapper for the next priority level.
  const children = nextPriorityLevels.length > 0 ? (0,preact__WEBPACK_IMPORTED_MODULE_0__.h)(Directives, {
    directives,
    priorityLevels: nextPriorityLevels,
    element,
    originalProps,
    previousScope: scope
  }) : element;
  const props = {
    ...originalProps,
    children
  };
  const directiveArgs = {
    directives,
    props,
    element,
    context,
    evaluate: scope.evaluate
  };
  setScope(scope);
  for (const directiveName of currentPriorityLevel) {
    const wrapper = directiveCallbacks[directiveName]?.(directiveArgs);
    if (wrapper !== undefined) {
      props.children = wrapper;
    }
  }
  resetScope();
  return props.children;
};

// Preact Options Hook called each time a vnode is created.
const old = preact__WEBPACK_IMPORTED_MODULE_0__.options.vnode;
preact__WEBPACK_IMPORTED_MODULE_0__.options.vnode = vnode => {
  if (vnode.props.__directives) {
    const props = vnode.props;
    const directives = props.__directives;
    if (directives.key) {
      vnode.key = directives.key.find(({
        suffix
      }) => suffix === 'default').value;
    }
    delete props.__directives;
    const priorityLevels = getPriorityLevels(directives);
    if (priorityLevels.length > 0) {
      vnode.props = {
        directives,
        priorityLevels,
        originalProps: props,
        type: vnode.type,
        element: (0,preact__WEBPACK_IMPORTED_MODULE_0__.h)(vnode.type, props),
        top: true
      };
      vnode.type = Directives;
    }
  }
  if (old) {
    old(vnode);
  }
};
//# sourceMappingURL=hooks.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/index.js":
/*!************************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/index.js ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getConfig: () => (/* reexport safe */ _store__WEBPACK_IMPORTED_MODULE_7__.getConfig),
/* harmony export */   getContext: () => (/* reexport safe */ _hooks__WEBPACK_IMPORTED_MODULE_6__.getContext),
/* harmony export */   getElement: () => (/* reexport safe */ _hooks__WEBPACK_IMPORTED_MODULE_6__.getElement),
/* harmony export */   privateApis: () => (/* binding */ privateApis),
/* harmony export */   splitTask: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.splitTask),
/* harmony export */   store: () => (/* reexport safe */ _store__WEBPACK_IMPORTED_MODULE_7__.store),
/* harmony export */   useCallback: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.useCallback),
/* harmony export */   useEffect: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.useEffect),
/* harmony export */   useInit: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.useInit),
/* harmony export */   useLayoutEffect: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.useLayoutEffect),
/* harmony export */   useMemo: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.useMemo),
/* harmony export */   useRef: () => (/* reexport safe */ preact_hooks__WEBPACK_IMPORTED_MODULE_9__.useRef),
/* harmony export */   useState: () => (/* reexport safe */ preact_hooks__WEBPACK_IMPORTED_MODULE_9__.useState),
/* harmony export */   useWatch: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.useWatch),
/* harmony export */   withScope: () => (/* reexport safe */ _utils__WEBPACK_IMPORTED_MODULE_8__.withScope)
/* harmony export */ });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "../omnipress-pro/node_modules/preact/dist/preact.module.js");
/* harmony import */ var _preact_signals__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @preact/signals */ "../omnipress-pro/node_modules/@preact/signals/dist/signals.module.js");
/* harmony import */ var deepsignal__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! deepsignal */ "../omnipress-pro/node_modules/deepsignal/dist/deepsignal.module.js");
/* harmony import */ var _directives__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./directives */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/directives.js");
/* harmony import */ var _init__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./init */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/init.js");
/* harmony import */ var _constants__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./constants */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/constants.js");
/* harmony import */ var _vdom__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./vdom */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/vdom.js");
/* harmony import */ var _hooks__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./hooks */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/hooks.js");
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./store */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/store.js");
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./utils */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/utils.js");
/* harmony import */ var preact_hooks__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! preact/hooks */ "../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js");
/**
 * External dependencies
 */




/**
 * Internal dependencies
 */










const requiredConsent = 'I acknowledge that using private APIs means my theme or plugin will inevitably break in the next version of WordPress.';
const privateApis = lock => {
  if (lock === requiredConsent) {
    return {
      directivePrefix: _constants__WEBPACK_IMPORTED_MODULE_4__.directivePrefix,
      getRegionRootFragment: _init__WEBPACK_IMPORTED_MODULE_3__.getRegionRootFragment,
      initialVdom: _init__WEBPACK_IMPORTED_MODULE_3__.initialVdom,
      toVdom: _vdom__WEBPACK_IMPORTED_MODULE_5__.toVdom,
      directive: _hooks__WEBPACK_IMPORTED_MODULE_6__.directive,
      getNamespace: _hooks__WEBPACK_IMPORTED_MODULE_6__.getNamespace,
      h: preact__WEBPACK_IMPORTED_MODULE_0__.h,
      cloneElement: preact__WEBPACK_IMPORTED_MODULE_0__.cloneElement,
      render: preact__WEBPACK_IMPORTED_MODULE_0__.render,
      deepSignal: deepsignal__WEBPACK_IMPORTED_MODULE_10__.deepSignal,
      parseInitialData: _store__WEBPACK_IMPORTED_MODULE_7__.parseInitialData,
      populateInitialData: _store__WEBPACK_IMPORTED_MODULE_7__.populateInitialData,
      batch: _preact_signals__WEBPACK_IMPORTED_MODULE_1__.batch
    };
  }
  throw new Error('Forbidden access.');
};
document.addEventListener('DOMContentLoaded', async () => {
  (0,_directives__WEBPACK_IMPORTED_MODULE_2__["default"])();
  await (0,_init__WEBPACK_IMPORTED_MODULE_3__.init)();
});
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/init.js":
/*!***********************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/init.js ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getRegionRootFragment: () => (/* binding */ getRegionRootFragment),
/* harmony export */   init: () => (/* binding */ init),
/* harmony export */   initialVdom: () => (/* binding */ initialVdom)
/* harmony export */ });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "../omnipress-pro/node_modules/preact/dist/preact.module.js");
/* harmony import */ var _vdom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./vdom */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/vdom.js");
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./utils */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/utils.js");
/* harmony import */ var _constants__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./constants */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/constants.js");
/**
 * External dependencies
 */

/**
 * Internal dependencies
 */




// Keep the same root fragment for each interactive region node.
const regionRootFragments = new WeakMap();
const getRegionRootFragment = region => {
  if (!region.parentElement) {
    throw Error('The passed region should be an element with a parent.');
  }
  if (!regionRootFragments.has(region)) {
    regionRootFragments.set(region, (0,_utils__WEBPACK_IMPORTED_MODULE_2__.createRootFragment)(region.parentElement, region));
  }
  return regionRootFragments.get(region);
};

// Initial vDOM regions associated with its DOM element.
const initialVdom = new WeakMap();

// Initialize the router with the initial DOM.
const init = async () => {
  const nodes = document.querySelectorAll(`[data-${_constants__WEBPACK_IMPORTED_MODULE_3__.directivePrefix}-interactive]`);
  for (const node of nodes) {
    if (!_vdom__WEBPACK_IMPORTED_MODULE_1__.hydratedIslands.has(node)) {
      await (0,_utils__WEBPACK_IMPORTED_MODULE_2__.splitTask)();
      const fragment = getRegionRootFragment(node);
      const vdom = (0,_vdom__WEBPACK_IMPORTED_MODULE_1__.toVdom)(node);
      initialVdom.set(node, vdom);
      await (0,_utils__WEBPACK_IMPORTED_MODULE_2__.splitTask)();
      (0,preact__WEBPACK_IMPORTED_MODULE_0__.hydrate)(vdom, fragment);
    }
  }
};
//# sourceMappingURL=init.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/store.js":
/*!************************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/store.js ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getConfig: () => (/* binding */ getConfig),
/* harmony export */   parseInitialData: () => (/* binding */ parseInitialData),
/* harmony export */   populateInitialData: () => (/* binding */ populateInitialData),
/* harmony export */   store: () => (/* binding */ store),
/* harmony export */   stores: () => (/* binding */ stores),
/* harmony export */   universalUnlock: () => (/* binding */ universalUnlock)
/* harmony export */ });
/* harmony import */ var deepsignal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! deepsignal */ "../omnipress-pro/node_modules/deepsignal/dist/deepsignal.module.js");
/* harmony import */ var _preact_signals__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @preact/signals */ "../omnipress-pro/node_modules/@preact/signals/dist/signals.module.js");
/* harmony import */ var _hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./hooks */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/hooks.js");
/**
 * External dependencies
 */



/**
 * Internal dependencies
 */

const isObject = item => Boolean(item && typeof item === 'object' && item.constructor === Object);
const deepMerge = (target, source) => {
  if (isObject(target) && isObject(source)) {
    for (const key in source) {
      const getter = Object.getOwnPropertyDescriptor(source, key)?.get;
      if (typeof getter === 'function') {
        Object.defineProperty(target, key, {
          get: getter
        });
      } else if (isObject(source[key])) {
        if (!target[key]) {
          target[key] = {};
        }
        deepMerge(target[key], source[key]);
      } else {
        try {
          target[key] = source[key];
        } catch (e) {
          // Assignemnts fail for properties that are only getters.
          // When that's the case, the assignment is simply ignored.
        }
      }
    }
  }
};
const stores = new Map();
const rawStores = new Map();
const storeLocks = new Map();
const storeConfigs = new Map();
const objToProxy = new WeakMap();
const proxyToNs = new WeakMap();
const scopeToGetters = new WeakMap();
const proxify = (obj, ns) => {
  if (!objToProxy.has(obj)) {
    const proxy = new Proxy(obj, handlers);
    objToProxy.set(obj, proxy);
    proxyToNs.set(proxy, ns);
  }
  return objToProxy.get(obj);
};
const handlers = {
  get: (target, key, receiver) => {
    const ns = proxyToNs.get(receiver);

    // Check if the property is a getter and we are inside an scope. If that is
    // the case, we clone the getter to avoid overwriting the scoped
    // dependencies of the computed each time that getter runs.
    const getter = Object.getOwnPropertyDescriptor(target, key)?.get;
    if (getter) {
      const scope = (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.getScope)();
      if (scope) {
        const getters = scopeToGetters.get(scope) || scopeToGetters.set(scope, new Map()).get(scope);
        if (!getters.has(getter)) {
          getters.set(getter, (0,_preact_signals__WEBPACK_IMPORTED_MODULE_0__.computed)(() => {
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.setNamespace)(ns);
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.setScope)(scope);
            try {
              return getter.call(target);
            } finally {
              (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.resetScope)();
              (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.resetNamespace)();
            }
          }));
        }
        return getters.get(getter).value;
      }
    }
    const result = Reflect.get(target, key);

    // Check if the proxy is the store root and no key with that name exist. In
    // that case, return an empty object for the requested key.
    if (typeof result === 'undefined' && receiver === stores.get(ns)) {
      const obj = {};
      Reflect.set(target, key, obj);
      return proxify(obj, ns);
    }

    // Check if the property is a generator. If it is, we turn it into an
    // asynchronous function where we restore the default namespace and scope
    // each time it awaits/yields.
    if (result?.constructor?.name === 'GeneratorFunction') {
      return async (...args) => {
        const scope = (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.getScope)();
        const gen = result(...args);
        let value;
        let it;
        while (true) {
          (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.setNamespace)(ns);
          (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.setScope)(scope);
          try {
            it = gen.next(value);
          } finally {
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.resetScope)();
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.resetNamespace)();
          }
          try {
            value = await it.value;
          } catch (e) {
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.setNamespace)(ns);
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.setScope)(scope);
            gen.throw(e);
          } finally {
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.resetScope)();
            (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.resetNamespace)();
          }
          if (it.done) {
            break;
          }
        }
        return value;
      };
    }

    // Check if the property is a synchronous function. If it is, set the
    // default namespace. Synchronous functions always run in the proper scope,
    // which is set by the Directives component.
    if (typeof result === 'function') {
      return (...args) => {
        (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.setNamespace)(ns);
        try {
          return result(...args);
        } finally {
          (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.resetNamespace)();
        }
      };
    }

    // Check if the property is an object. If it is, proxyify it.
    if (isObject(result)) {
      return proxify(result, ns);
    }
    return result;
  },
  // Prevents passing the current proxy as the receiver to the deepSignal.
  set(target, key, value) {
    return Reflect.set(target, key, value);
  }
};

/**
 * Get the defined config for the store with the passed namespace.
 *
 * @param namespace Store's namespace from which to retrieve the config.
 * @return Defined config for the given namespace.
 */
const getConfig = namespace => storeConfigs.get(namespace || (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.getNamespace)()) || {};
const universalUnlock = 'I acknowledge that using a private store means my plugin will inevitably break on the next store release.';

/**
 * Extends the Interactivity API global store adding the passed properties to
 * the given namespace. It also returns stable references to the namespace
 * content.
 *
 * These props typically consist of `state`, which is the reactive part of the
 * store ― which means that any directive referencing a state property will be
 * re-rendered anytime it changes ― and function properties like `actions` and
 * `callbacks`, mostly used for event handlers. These props can then be
 * referenced by any directive to make the HTML interactive.
 *
 * @example
 * ```js
 *  const { state } = store( 'counter', {
 *    state: {
 *      value: 0,
 *      get double() { return state.value * 2; },
 *    },
 *    actions: {
 *      increment() {
 *        state.value += 1;
 *      },
 *    },
 *  } );
 * ```
 *
 * The code from the example above allows blocks to subscribe and interact with
 * the store by using directives in the HTML, e.g.:
 *
 * ```html
 * <div data-wp-interactive="counter">
 *   <button
 *     data-wp-text="state.double"
 *     data-wp-on--click="actions.increment"
 *   >
 *     0
 *   </button>
 * </div>
 * ```
 * @param namespace The store namespace to interact with.
 * @param storePart Properties to add to the store namespace.
 * @param options   Options for the given namespace.
 *
 * @return A reference to the namespace content.
 */

function store(namespace, {
  state = {},
  ...block
} = {}, {
  lock = false
} = {}) {
  if (!stores.has(namespace)) {
    // Lock the store if the passed lock is different from the universal
    // unlock. Once the lock is set (either false, true, or a given string),
    // it cannot change.
    if (lock !== universalUnlock) {
      storeLocks.set(namespace, lock);
    }
    const rawStore = {
      state: (0,deepsignal__WEBPACK_IMPORTED_MODULE_2__.deepSignal)(isObject(state) ? state : {}),
      ...block
    };
    const proxiedStore = new Proxy(rawStore, handlers);
    rawStores.set(namespace, rawStore);
    stores.set(namespace, proxiedStore);
    proxyToNs.set(proxiedStore, namespace);
  } else {
    // Lock the store if it wasn't locked yet and the passed lock is
    // different from the universal unlock. If no lock is given, the store
    // will be public and won't accept any lock from now on.
    if (lock !== universalUnlock && !storeLocks.has(namespace)) {
      storeLocks.set(namespace, lock);
    } else {
      const storeLock = storeLocks.get(namespace);
      const isLockValid = lock === universalUnlock || lock !== true && lock === storeLock;
      if (!isLockValid) {
        if (!storeLock) {
          throw Error('Cannot lock a public store');
        } else {
          throw Error('Cannot unlock a private store with an invalid lock code');
        }
      }
    }
    const target = rawStores.get(namespace);
    deepMerge(target, block);
    deepMerge(target.state, state);
  }
  return stores.get(namespace);
}
const parseInitialData = (dom = document) => {
  var _dom$getElementById;
  const jsonDataScriptTag = // Preferred Script Module data passing form
  (_dom$getElementById = dom.getElementById('wp-script-module-data-@wordpress/interactivity')) !== null && _dom$getElementById !== void 0 ? _dom$getElementById :
  // Legacy form
  dom.getElementById('wp-interactivity-data');
  if (jsonDataScriptTag?.textContent) {
    try {
      return JSON.parse(jsonDataScriptTag.textContent);
    } catch {}
  }
  return {};
};
const populateInitialData = data => {
  if (isObject(data?.state)) {
    Object.entries(data.state).forEach(([namespace, state]) => {
      store(namespace, {
        state
      }, {
        lock: universalUnlock
      });
    });
  }
  if (isObject(data?.config)) {
    Object.entries(data.config).forEach(([namespace, config]) => {
      storeConfigs.set(namespace, config);
    });
  }
};

// Parse and populate the initial state and config.
const data = parseInitialData();
populateInitialData(data);
//# sourceMappingURL=store.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/utils.js":
/*!************************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/utils.js ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   createRootFragment: () => (/* binding */ createRootFragment),
/* harmony export */   kebabToCamelCase: () => (/* binding */ kebabToCamelCase),
/* harmony export */   splitTask: () => (/* binding */ splitTask),
/* harmony export */   useCallback: () => (/* binding */ useCallback),
/* harmony export */   useEffect: () => (/* binding */ useEffect),
/* harmony export */   useInit: () => (/* binding */ useInit),
/* harmony export */   useLayoutEffect: () => (/* binding */ useLayoutEffect),
/* harmony export */   useMemo: () => (/* binding */ useMemo),
/* harmony export */   useSignalEffect: () => (/* binding */ useSignalEffect),
/* harmony export */   useWatch: () => (/* binding */ useWatch),
/* harmony export */   warn: () => (/* binding */ warn),
/* harmony export */   withScope: () => (/* binding */ withScope)
/* harmony export */ });
/* harmony import */ var preact_hooks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact/hooks */ "../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js");
/* harmony import */ var _preact_signals__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @preact/signals */ "../omnipress-pro/node_modules/@preact/signals/dist/signals.module.js");
/* harmony import */ var _hooks__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./hooks */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/hooks.js");
/**
 * External dependencies
 */



/**
 * Internal dependencies
 */

/**
 * Executes a callback function after the next frame is rendered.
 *
 * @param callback The callback function to be executed.
 * @return A promise that resolves after the callback function is executed.
 */
const afterNextFrame = callback => {
  return new Promise(resolve => {
    const done = () => {
      clearTimeout(timeout);
      window.cancelAnimationFrame(raf);
      setTimeout(() => {
        callback();
        resolve();
      });
    };
    const timeout = setTimeout(done, 100);
    const raf = window.requestAnimationFrame(done);
  });
};

/**
 * Returns a promise that resolves after yielding to main.
 *
 * @return Promise
 */
const splitTask = () => {
  return new Promise(resolve => {
    // TODO: Use scheduler.yield() when available.
    setTimeout(resolve, 0);
  });
};

/**
 * Creates a Flusher object that can be used to flush computed values and notify listeners.
 *
 * Using the mangled properties:
 * this.c: this._callback
 * this.x: this._compute
 * https://github.com/preactjs/signals/blob/main/mangle.json
 *
 * @param compute The function that computes the value to be flushed.
 * @param notify  The function that notifies listeners when the value is flushed.
 * @return The Flusher object with `flush` and `dispose` properties.
 */
function createFlusher(compute, notify) {
  let flush = () => undefined;
  const dispose = (0,_preact_signals__WEBPACK_IMPORTED_MODULE_1__.effect)(function () {
    flush = this.c.bind(this);
    this.x = compute;
    this.c = notify;
    return compute();
  });
  return {
    flush,
    dispose
  };
}

/**
 * Custom hook that executes a callback function whenever a signal is triggered.
 * Version of `useSignalEffect` with a `useEffect`-like execution. This hook
 * implementation comes from this PR, but we added short-cirtuiting to avoid
 * infinite loops: https://github.com/preactjs/signals/pull/290
 *
 * @param callback The callback function to be executed.
 */
function useSignalEffect(callback) {
  (0,preact_hooks__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    let eff = null;
    let isExecuting = false;
    const notify = async () => {
      if (eff && !isExecuting) {
        isExecuting = true;
        await afterNextFrame(eff.flush);
        isExecuting = false;
      }
    };
    eff = createFlusher(callback, notify);
    return eff.dispose;
  }, []);
}

/**
 * Returns the passed function wrapped with the current scope so it is
 * accessible whenever the function runs. This is primarily to make the scope
 * available inside hook callbacks.
 *
 * Asyncronous functions should use generators that yield promises instead of awaiting them.
 * See the documentation for details: https://developer.wordpress.org/block-editor/reference-guides/packages/packages-interactivity/packages-interactivity-api-reference/#the-store
 *
 * @param func The passed function.
 * @return The wrapped function.
 */

function withScope(func) {
  const scope = (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.getScope)();
  const ns = (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.getNamespace)();
  if (func?.constructor?.name === 'GeneratorFunction') {
    return async (...args) => {
      const gen = func(...args);
      let value;
      let it;
      while (true) {
        (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.setNamespace)(ns);
        (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.setScope)(scope);
        try {
          it = gen.next(value);
        } finally {
          (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.resetNamespace)();
          (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.resetScope)();
        }
        try {
          value = await it.value;
        } catch (e) {
          gen.throw(e);
        }
        if (it.done) {
          break;
        }
      }
      return value;
    };
  }
  return (...args) => {
    (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.setNamespace)(ns);
    (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.setScope)(scope);
    try {
      return func(...args);
    } finally {
      (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.resetNamespace)();
      (0,_hooks__WEBPACK_IMPORTED_MODULE_2__.resetScope)();
    }
  };
}

/**
 * Accepts a function that contains imperative code which runs whenever any of
 * the accessed _reactive_ properties (e.g., values from the global state or the
 * context) is modified.
 *
 * This hook makes the element's scope available so functions like
 * `getElement()` and `getContext()` can be used inside the passed callback.
 *
 * @param callback The hook callback.
 */
function useWatch(callback) {
  useSignalEffect(withScope(callback));
}

/**
 * Accepts a function that contains imperative code which runs only after the
 * element's first render, mainly useful for intialization logic.
 *
 * This hook makes the element's scope available so functions like
 * `getElement()` and `getContext()` can be used inside the passed callback.
 *
 * @param callback The hook callback.
 */
function useInit(callback) {
  (0,preact_hooks__WEBPACK_IMPORTED_MODULE_0__.useEffect)(withScope(callback), []);
}

/**
 * Accepts a function that contains imperative, possibly effectful code. The
 * effects run after browser paint, without blocking it.
 *
 * This hook is equivalent to Preact's `useEffect` and makes the element's scope
 * available so functions like `getElement()` and `getContext()` can be used
 * inside the passed callback.
 *
 * @param callback Imperative function that can return a cleanup
 *                 function.
 * @param inputs   If present, effect will only activate if the
 *                 values in the list change (using `===`).
 */
function useEffect(callback, inputs) {
  (0,preact_hooks__WEBPACK_IMPORTED_MODULE_0__.useEffect)(withScope(callback), inputs);
}

/**
 * Accepts a function that contains imperative, possibly effectful code. Use
 * this to read layout from the DOM and synchronously re-render.
 *
 * This hook is equivalent to Preact's `useLayoutEffect` and makes the element's
 * scope available so functions like `getElement()` and `getContext()` can be
 * used inside the passed callback.
 *
 * @param callback Imperative function that can return a cleanup
 *                 function.
 * @param inputs   If present, effect will only activate if the
 *                 values in the list change (using `===`).
 */
function useLayoutEffect(callback, inputs) {
  (0,preact_hooks__WEBPACK_IMPORTED_MODULE_0__.useLayoutEffect)(withScope(callback), inputs);
}

/**
 * Returns a memoized version of the callback that only changes if one of the
 * inputs has changed (using `===`).
 *
 * This hook is equivalent to Preact's `useCallback` and makes the element's
 * scope available so functions like `getElement()` and `getContext()` can be
 * used inside the passed callback.
 *
 * @param callback Callback function.
 * @param inputs   If present, the callback will only be updated if the
 *                 values in the list change (using `===`).
 *
 * @return The callback function.
 */
function useCallback(callback, inputs) {
  return (0,preact_hooks__WEBPACK_IMPORTED_MODULE_0__.useCallback)(withScope(callback), inputs);
}

/**
 * Pass a factory function and an array of inputs. `useMemo` will only recompute
 * the memoized value when one of the inputs has changed.
 *
 * This hook is equivalent to Preact's `useMemo` and makes the element's scope
 * available so functions like `getElement()` and `getContext()` can be used
 * inside the passed factory function.
 *
 * @param factory Factory function that returns that value for memoization.
 * @param inputs  If present, the factory will only be run to recompute if
 *                the values in the list change (using `===`).
 *
 * @return The memoized value.
 */
function useMemo(factory, inputs) {
  return (0,preact_hooks__WEBPACK_IMPORTED_MODULE_0__.useMemo)(withScope(factory), inputs);
}

/**
 * Creates a root fragment by replacing a node or an array of nodes in a parent element.
 * For wrapperless hydration.
 * See https://gist.github.com/developit/f4c67a2ede71dc2fab7f357f39cff28c
 *
 * @param parent      The parent element where the nodes will be replaced.
 * @param replaceNode The node or array of nodes to replace in the parent element.
 * @return The created root fragment.
 */
const createRootFragment = (parent, replaceNode) => {
  replaceNode = [].concat(replaceNode);
  const sibling = replaceNode[replaceNode.length - 1].nextSibling;
  function insert(child, root) {
    parent.insertBefore(child, root || sibling);
  }
  return parent.__k = {
    nodeType: 1,
    parentNode: parent,
    firstChild: replaceNode[0],
    childNodes: replaceNode,
    insertBefore: insert,
    appendChild: insert,
    removeChild(c) {
      parent.removeChild(c);
    }
  };
};

/**
 * Transforms a kebab-case string to camelCase.
 *
 * @param str The kebab-case string to transform to camelCase.
 * @return The transformed camelCase string.
 */
function kebabToCamelCase(str) {
  return str.replace(/^-+|-+$/g, '').toLowerCase().replace(/-([a-z])/g, function (_match, group1) {
    return group1.toUpperCase();
  });
}
const logged = new Set();

/**
 * Shows a warning with `message` if environment is not `production`.
 *
 * Based on the `@wordpress/warning` package.
 *
 * @param message Message to show in the warning.
 */
const warn = message => {
  if (globalThis.SCRIPT_DEBUG) {
    if (logged.has(message)) {
      return;
    }

    // eslint-disable-next-line no-console
    console.warn(message);

    // Throwing an error and catching it immediately to improve debugging
    // A consumer can use 'pause on caught exceptions'
    try {
      throw Error(message);
    } catch (e) {
      // Do nothing.
    }
    logged.add(message);
  }
};
//# sourceMappingURL=utils.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/vdom.js":
/*!***********************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@wordpress/interactivity/build-module/vdom.js ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   hydratedIslands: () => (/* binding */ hydratedIslands),
/* harmony export */   toVdom: () => (/* binding */ toVdom)
/* harmony export */ });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "../omnipress-pro/node_modules/preact/dist/preact.module.js");
/* harmony import */ var _constants__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./constants */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/constants.js");
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./utils */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/utils.js");
/**
 * External dependencies
 */

/**
 * Internal dependencies
 */


const ignoreAttr = `data-${_constants__WEBPACK_IMPORTED_MODULE_1__.directivePrefix}-ignore`;
const islandAttr = `data-${_constants__WEBPACK_IMPORTED_MODULE_1__.directivePrefix}-interactive`;
const fullPrefix = `data-${_constants__WEBPACK_IMPORTED_MODULE_1__.directivePrefix}-`;
const namespaces = [];
const currentNamespace = () => {
  var _namespaces;
  return (_namespaces = namespaces[namespaces.length - 1]) !== null && _namespaces !== void 0 ? _namespaces : null;
};
const isObject = item => Boolean(item && typeof item === 'object' && item.constructor === Object);

// Regular expression for directive parsing.
const directiveParser = new RegExp(`^data-${_constants__WEBPACK_IMPORTED_MODULE_1__.directivePrefix}-` +
// ${p} must be a prefix string, like 'wp'.
// Match alphanumeric characters including hyphen-separated
// segments. It excludes underscore intentionally to prevent confusion.
// E.g., "custom-directive".
'([a-z0-9]+(?:-[a-z0-9]+)*)' +
// (Optional) Match '--' followed by any alphanumeric charachters. It
// excludes underscore intentionally to prevent confusion, but it can
// contain multiple hyphens. E.g., "--custom-prefix--with-more-info".
'(?:--([a-z0-9_-]+))?$', 'i' // Case insensitive.
);

// Regular expression for reference parsing. It can contain a namespace before
// the reference, separated by `::`, like `some-namespace::state.somePath`.
// Namespaces can contain any alphanumeric characters, hyphens, underscores or
// forward slashes. References don't have any restrictions.
const nsPathRegExp = /^([\w_\/-]+)::(.+)$/;
const hydratedIslands = new WeakSet();

/**
 * Recursive function that transforms a DOM tree into vDOM.
 *
 * @param root The root element or node to start traversing on.
 * @return The resulting vDOM tree.
 */
function toVdom(root) {
  const treeWalker = document.createTreeWalker(root, 205 // TEXT + CDATA_SECTION + COMMENT + PROCESSING_INSTRUCTION + ELEMENT
  );
  function walk(node) {
    const {
      nodeType
    } = node;

    // TEXT_NODE (3)
    if (nodeType === 3) {
      return [node.data];
    }

    // CDATA_SECTION_NODE (4)
    if (nodeType === 4) {
      var _nodeValue;
      const next = treeWalker.nextSibling();
      node.replaceWith(new window.Text((_nodeValue = node.nodeValue) !== null && _nodeValue !== void 0 ? _nodeValue : ''));
      return [node.nodeValue, next];
    }

    // COMMENT_NODE (8) || PROCESSING_INSTRUCTION_NODE (7)
    if (nodeType === 8 || nodeType === 7) {
      const next = treeWalker.nextSibling();
      node.remove();
      return [null, next];
    }
    const elementNode = node;
    const {
      attributes
    } = elementNode;
    const localName = elementNode.localName;
    const props = {};
    const children = [];
    const directives = [];
    let ignore = false;
    let island = false;
    for (let i = 0; i < attributes.length; i++) {
      const attributeName = attributes[i].name;
      const attributeValue = attributes[i].value;
      if (attributeName[fullPrefix.length] && attributeName.slice(0, fullPrefix.length) === fullPrefix) {
        if (attributeName === ignoreAttr) {
          ignore = true;
        } else {
          var _regexResult$, _regexResult$2;
          const regexResult = nsPathRegExp.exec(attributeValue);
          const namespace = (_regexResult$ = regexResult?.[1]) !== null && _regexResult$ !== void 0 ? _regexResult$ : null;
          let value = (_regexResult$2 = regexResult?.[2]) !== null && _regexResult$2 !== void 0 ? _regexResult$2 : attributeValue;
          try {
            const parsedValue = JSON.parse(value);
            value = isObject(parsedValue) ? parsedValue : value;
          } catch {}
          if (attributeName === islandAttr) {
            island = true;
            const islandNamespace =
            // eslint-disable-next-line no-nested-ternary
            typeof value === 'string' ? value : typeof value?.namespace === 'string' ? value.namespace : null;
            namespaces.push(islandNamespace);
          } else {
            directives.push([attributeName, namespace, value]);
          }
        }
      } else if (attributeName === 'ref') {
        continue;
      }
      props[attributeName] = attributeValue;
    }
    if (ignore && !island) {
      return [(0,preact__WEBPACK_IMPORTED_MODULE_0__.h)(localName, {
        ...props,
        innerHTML: elementNode.innerHTML,
        __directives: {
          ignore: true
        }
      })];
    }
    if (island) {
      hydratedIslands.add(elementNode);
    }
    if (directives.length) {
      props.__directives = directives.reduce((obj, [name, ns, value]) => {
        const directiveMatch = directiveParser.exec(name);
        if (directiveMatch === null) {
          (0,_utils__WEBPACK_IMPORTED_MODULE_2__.warn)(`Found malformed directive name: ${name}.`);
          return obj;
        }
        const prefix = directiveMatch[1] || '';
        const suffix = directiveMatch[2] || 'default';
        obj[prefix] = obj[prefix] || [];
        obj[prefix].push({
          namespace: ns !== null && ns !== void 0 ? ns : currentNamespace(),
          value,
          suffix
        });
        return obj;
      }, {});
    }

    // @ts-expect-error Fixed in upcoming preact release https://github.com/preactjs/preact/pull/4334
    if (localName === 'template') {
      props.content = [...elementNode.content.childNodes].map(childNode => toVdom(childNode));
    } else {
      let child = treeWalker.firstChild();
      if (child) {
        while (child) {
          const [vnode, nextChild] = walk(child);
          if (vnode) {
            children.push(vnode);
          }
          child = nextChild || treeWalker.nextSibling();
        }
        treeWalker.parentNode();
      }
    }

    // Restore previous namespace.
    if (island) {
      namespaces.pop();
    }
    return [(0,preact__WEBPACK_IMPORTED_MODULE_0__.h)(localName, props, children)];
  }
  return walk(treeWalker.currentNode);
}
//# sourceMappingURL=vdom.js.map

/***/ }),

/***/ "../omnipress-pro/node_modules/deepsignal/dist/deepsignal.module.js":
/*!**************************************************************************!*\
  !*** ../omnipress-pro/node_modules/deepsignal/dist/deepsignal.module.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   deepSignal: () => (/* binding */ g),
/* harmony export */   peek: () => (/* binding */ p),
/* harmony export */   shallow: () => (/* binding */ h),
/* harmony export */   useDeepSignal: () => (/* binding */ M)
/* harmony export */ });
/* harmony import */ var _preact_signals__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @preact/signals */ "../omnipress-pro/node_modules/@preact/signals/dist/signals.module.js");
/* harmony import */ var preact_hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! preact/hooks */ "../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js");
/* harmony import */ var _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @preact/signals-core */ "../omnipress-pro/node_modules/@preact/signals-core/dist/signals-core.module.js");
var a=new WeakMap,o=new WeakMap,s=new WeakMap,u=new WeakSet,c=new WeakMap,f=/^\$/,i=Object.getOwnPropertyDescriptor,l=!1,g=function(e){if(!k(e))throw new Error("This object can't be observed.");return o.has(e)||o.set(e,v(e,d)),o.get(e)},p=function(e,t){l=!0;var r=e[t];try{l=!1}catch(e){}return r};function h(e){return u.add(e),e}var v=function(e,t){var r=new Proxy(e,t);return u.add(r),r},y=function(){throw new Error("Don't mutate the signals directly.")},w=function(e){return function(t,u,c){var g;if(l)return Reflect.get(t,u,c);var p=e||"$"===u[0];if(!e&&p&&Array.isArray(t)){if("$"===u)return s.has(t)||s.set(t,v(t,m)),s.get(t);p="$length"===u}a.has(c)||a.set(c,new Map);var h=a.get(c),y=p?u.replace(f,""):u;if(h.has(y)||"function"!=typeof(null==(g=i(t,y))?void 0:g.get)){var w=Reflect.get(t,y,c);if(p&&"function"==typeof w)return;if("symbol"==typeof y&&b.has(y))return w;h.has(y)||(k(w)&&(o.has(w)||o.set(w,v(w,d)),w=o.get(w)),h.set(y,(0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.signal)(w)))}else h.set(y,(0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.computed)(function(){return Reflect.get(t,y,c)}));return p?h.get(y):h.get(y).value}},d={get:w(!1),set:function(e,n,s,u){var l;if("function"==typeof(null==(l=i(e,n))?void 0:l.set))return Reflect.set(e,n,s,u);a.has(u)||a.set(u,new Map);var g=a.get(u);if("$"===n[0]){s instanceof _preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.Signal||y();var p=n.replace(f,"");return g.set(p,s),Reflect.set(e,p,s.peek(),u)}var h=s;k(s)&&(o.has(s)||o.set(s,v(s,d)),h=o.get(s));var w=!(n in e),m=Reflect.set(e,n,s,u);return g.has(n)?g.get(n).value=h:g.set(n,(0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.signal)(h)),w&&c.has(e)&&c.get(e).value++,Array.isArray(e)&&g.has("length")&&(g.get("length").value=e.length),m},deleteProperty:function(e,t){"$"===t[0]&&y();var r=a.get(o.get(e)),n=Reflect.deleteProperty(e,t);return r&&r.has(t)&&(r.get(t).value=void 0),c.has(e)&&c.get(e).value++,n},ownKeys:function(e){return c.has(e)||c.set(e,(0,_preact_signals_core__WEBPACK_IMPORTED_MODULE_2__.signal)(0)),c._=c.get(e).value,Reflect.ownKeys(e)}},m={get:w(!0),set:y,deleteProperty:y},b=new Set(Object.getOwnPropertyNames(Symbol).map(function(e){return Symbol[e]}).filter(function(e){return"symbol"==typeof e})),R=new Set([Object,Array]),k=function(e){return"object"==typeof e&&null!==e&&R.has(e.constructor)&&!u.has(e)},M=function(t){return (0,preact_hooks__WEBPACK_IMPORTED_MODULE_1__.useMemo)(function(){return g(t)},[])};//# sourceMappingURL=deepsignal.module.js.map


/***/ }),

/***/ "../omnipress-pro/node_modules/preact/dist/preact.module.js":
/*!******************************************************************!*\
  !*** ../omnipress-pro/node_modules/preact/dist/preact.module.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Component: () => (/* binding */ b),
/* harmony export */   Fragment: () => (/* binding */ k),
/* harmony export */   cloneElement: () => (/* binding */ E),
/* harmony export */   createContext: () => (/* binding */ G),
/* harmony export */   createElement: () => (/* binding */ _),
/* harmony export */   createRef: () => (/* binding */ m),
/* harmony export */   h: () => (/* binding */ _),
/* harmony export */   hydrate: () => (/* binding */ D),
/* harmony export */   isValidElement: () => (/* binding */ t),
/* harmony export */   options: () => (/* binding */ l),
/* harmony export */   render: () => (/* binding */ B),
/* harmony export */   toChildArray: () => (/* binding */ H)
/* harmony export */ });
var n,l,u,t,i,o,r,f,e,c,s,a,h={},p=[],v=/acit|ex(?:s|g|n|p|$)|rph|grid|ows|mnc|ntw|ine[ch]|zoo|^ord|itera/i,y=Array.isArray;function d(n,l){for(var u in l)n[u]=l[u];return n}function w(n){var l=n.parentNode;l&&l.removeChild(n)}function _(l,u,t){var i,o,r,f={};for(r in u)"key"==r?i=u[r]:"ref"==r?o=u[r]:f[r]=u[r];if(arguments.length>2&&(f.children=arguments.length>3?n.call(arguments,2):t),"function"==typeof l&&null!=l.defaultProps)for(r in l.defaultProps)void 0===f[r]&&(f[r]=l.defaultProps[r]);return g(l,f,i,o,null)}function g(n,t,i,o,r){var f={type:n,props:t,key:i,ref:o,__k:null,__:null,__b:0,__e:null,__d:void 0,__c:null,constructor:void 0,__v:null==r?++u:r,__i:-1,__u:0};return null==r&&null!=l.vnode&&l.vnode(f),f}function m(){return{current:null}}function k(n){return n.children}function b(n,l){this.props=n,this.context=l}function x(n,l){if(null==l)return n.__?x(n.__,n.__i+1):null;for(var u;l<n.__k.length;l++)if(null!=(u=n.__k[l])&&null!=u.__e)return u.__e;return"function"==typeof n.type?x(n):null}function C(n){var l,u;if(null!=(n=n.__)&&null!=n.__c){for(n.__e=n.__c.base=null,l=0;l<n.__k.length;l++)if(null!=(u=n.__k[l])&&null!=u.__e){n.__e=n.__c.base=u.__e;break}return C(n)}}function M(n){(!n.__d&&(n.__d=!0)&&i.push(n)&&!P.__r++||o!==l.debounceRendering)&&((o=l.debounceRendering)||r)(P)}function P(){var n,u,t,o,r,e,c,s;for(i.sort(f);n=i.shift();)n.__d&&(u=i.length,o=void 0,e=(r=(t=n).__v).__e,c=[],s=[],t.__P&&((o=d({},r)).__v=r.__v+1,l.vnode&&l.vnode(o),O(t.__P,o,r,t.__n,t.__P.namespaceURI,32&r.__u?[e]:null,c,null==e?x(r):e,!!(32&r.__u),s),o.__v=r.__v,o.__.__k[o.__i]=o,j(c,o,s),o.__e!=e&&C(o)),i.length>u&&i.sort(f));P.__r=0}function S(n,l,u,t,i,o,r,f,e,c,s){var a,v,y,d,w,_=t&&t.__k||p,g=l.length;for(u.__d=e,$(u,l,_),e=u.__d,a=0;a<g;a++)null!=(y=u.__k[a])&&"boolean"!=typeof y&&"function"!=typeof y&&(v=-1===y.__i?h:_[y.__i]||h,y.__i=a,O(n,y,v,i,o,r,f,e,c,s),d=y.__e,y.ref&&v.ref!=y.ref&&(v.ref&&N(v.ref,null,y),s.push(y.ref,y.__c||d,y)),null==w&&null!=d&&(w=d),65536&y.__u||v.__k===y.__k?(e&&"string"==typeof y.type&&!n.contains(e)&&(e=x(v)),e=I(y,e,n)):"function"==typeof y.type&&void 0!==y.__d?e=y.__d:d&&(e=d.nextSibling),y.__d=void 0,y.__u&=-196609);u.__d=e,u.__e=w}function $(n,l,u){var t,i,o,r,f,e=l.length,c=u.length,s=c,a=0;for(n.__k=[],t=0;t<e;t++)r=t+a,null!=(i=n.__k[t]=null==(i=l[t])||"boolean"==typeof i||"function"==typeof i?null:"string"==typeof i||"number"==typeof i||"bigint"==typeof i||i.constructor==String?g(null,i,null,null,null):y(i)?g(k,{children:i},null,null,null):void 0===i.constructor&&i.__b>0?g(i.type,i.props,i.key,i.ref?i.ref:null,i.__v):i)?(i.__=n,i.__b=n.__b+1,f=L(i,u,r,s),i.__i=f,o=null,-1!==f&&(s--,(o=u[f])&&(o.__u|=131072)),null==o||null===o.__v?(-1==f&&a--,"function"!=typeof i.type&&(i.__u|=65536)):f!==r&&(f==r-1?a=f-r:f==r+1?a++:f>r?s>e-r?a+=f-r:a--:f<r&&a++,f!==t+a&&(i.__u|=65536))):(o=u[r])&&null==o.key&&o.__e&&0==(131072&o.__u)&&(o.__e==n.__d&&(n.__d=x(o)),V(o,o,!1),u[r]=null,s--);if(s)for(t=0;t<c;t++)null!=(o=u[t])&&0==(131072&o.__u)&&(o.__e==n.__d&&(n.__d=x(o)),V(o,o))}function I(n,l,u){var t,i;if("function"==typeof n.type){for(t=n.__k,i=0;t&&i<t.length;i++)t[i]&&(t[i].__=n,l=I(t[i],l,u));return l}n.__e!=l&&(u.insertBefore(n.__e,l||null),l=n.__e);do{l=l&&l.nextSibling}while(null!=l&&8===l.nodeType);return l}function H(n,l){return l=l||[],null==n||"boolean"==typeof n||(y(n)?n.some(function(n){H(n,l)}):l.push(n)),l}function L(n,l,u,t){var i=n.key,o=n.type,r=u-1,f=u+1,e=l[u];if(null===e||e&&i==e.key&&o===e.type&&0==(131072&e.__u))return u;if(t>(null!=e&&0==(131072&e.__u)?1:0))for(;r>=0||f<l.length;){if(r>=0){if((e=l[r])&&0==(131072&e.__u)&&i==e.key&&o===e.type)return r;r--}if(f<l.length){if((e=l[f])&&0==(131072&e.__u)&&i==e.key&&o===e.type)return f;f++}}return-1}function T(n,l,u){"-"===l[0]?n.setProperty(l,null==u?"":u):n[l]=null==u?"":"number"!=typeof u||v.test(l)?u:u+"px"}function A(n,l,u,t,i){var o;n:if("style"===l)if("string"==typeof u)n.style.cssText=u;else{if("string"==typeof t&&(n.style.cssText=t=""),t)for(l in t)u&&l in u||T(n.style,l,"");if(u)for(l in u)t&&u[l]===t[l]||T(n.style,l,u[l])}else if("o"===l[0]&&"n"===l[1])o=l!==(l=l.replace(/(PointerCapture)$|Capture$/i,"$1")),l=l.toLowerCase()in n||"onFocusOut"===l||"onFocusIn"===l?l.toLowerCase().slice(2):l.slice(2),n.l||(n.l={}),n.l[l+o]=u,u?t?u.u=t.u:(u.u=e,n.addEventListener(l,o?s:c,o)):n.removeEventListener(l,o?s:c,o);else{if("http://www.w3.org/2000/svg"==i)l=l.replace(/xlink(H|:h)/,"h").replace(/sName$/,"s");else if("width"!=l&&"height"!=l&&"href"!=l&&"list"!=l&&"form"!=l&&"tabIndex"!=l&&"download"!=l&&"rowSpan"!=l&&"colSpan"!=l&&"role"!=l&&"popover"!=l&&l in n)try{n[l]=null==u?"":u;break n}catch(n){}"function"==typeof u||(null==u||!1===u&&"-"!==l[4]?n.removeAttribute(l):n.setAttribute(l,"popover"==l&&1==u?"":u))}}function F(n){return function(u){if(this.l){var t=this.l[u.type+n];if(null==u.t)u.t=e++;else if(u.t<t.u)return;return t(l.event?l.event(u):u)}}}function O(n,u,t,i,o,r,f,e,c,s){var a,h,p,v,w,_,g,m,x,C,M,P,$,I,H,L,T=u.type;if(void 0!==u.constructor)return null;128&t.__u&&(c=!!(32&t.__u),r=[e=u.__e=t.__e]),(a=l.__b)&&a(u);n:if("function"==typeof T)try{if(m=u.props,x="prototype"in T&&T.prototype.render,C=(a=T.contextType)&&i[a.__c],M=a?C?C.props.value:a.__:i,t.__c?g=(h=u.__c=t.__c).__=h.__E:(x?u.__c=h=new T(m,M):(u.__c=h=new b(m,M),h.constructor=T,h.render=q),C&&C.sub(h),h.props=m,h.state||(h.state={}),h.context=M,h.__n=i,p=h.__d=!0,h.__h=[],h._sb=[]),x&&null==h.__s&&(h.__s=h.state),x&&null!=T.getDerivedStateFromProps&&(h.__s==h.state&&(h.__s=d({},h.__s)),d(h.__s,T.getDerivedStateFromProps(m,h.__s))),v=h.props,w=h.state,h.__v=u,p)x&&null==T.getDerivedStateFromProps&&null!=h.componentWillMount&&h.componentWillMount(),x&&null!=h.componentDidMount&&h.__h.push(h.componentDidMount);else{if(x&&null==T.getDerivedStateFromProps&&m!==v&&null!=h.componentWillReceiveProps&&h.componentWillReceiveProps(m,M),!h.__e&&(null!=h.shouldComponentUpdate&&!1===h.shouldComponentUpdate(m,h.__s,M)||u.__v===t.__v)){for(u.__v!==t.__v&&(h.props=m,h.state=h.__s,h.__d=!1),u.__e=t.__e,u.__k=t.__k,u.__k.forEach(function(n){n&&(n.__=u)}),P=0;P<h._sb.length;P++)h.__h.push(h._sb[P]);h._sb=[],h.__h.length&&f.push(h);break n}null!=h.componentWillUpdate&&h.componentWillUpdate(m,h.__s,M),x&&null!=h.componentDidUpdate&&h.__h.push(function(){h.componentDidUpdate(v,w,_)})}if(h.context=M,h.props=m,h.__P=n,h.__e=!1,$=l.__r,I=0,x){for(h.state=h.__s,h.__d=!1,$&&$(u),a=h.render(h.props,h.state,h.context),H=0;H<h._sb.length;H++)h.__h.push(h._sb[H]);h._sb=[]}else do{h.__d=!1,$&&$(u),a=h.render(h.props,h.state,h.context),h.state=h.__s}while(h.__d&&++I<25);h.state=h.__s,null!=h.getChildContext&&(i=d(d({},i),h.getChildContext())),x&&!p&&null!=h.getSnapshotBeforeUpdate&&(_=h.getSnapshotBeforeUpdate(v,w)),S(n,y(L=null!=a&&a.type===k&&null==a.key?a.props.children:a)?L:[L],u,t,i,o,r,f,e,c,s),h.base=u.__e,u.__u&=-161,h.__h.length&&f.push(h),g&&(h.__E=h.__=null)}catch(n){u.__v=null,c||null!=r?(u.__e=e,u.__u|=c?160:32,r[r.indexOf(e)]=null):(u.__e=t.__e,u.__k=t.__k),l.__e(n,u,t)}else null==r&&u.__v===t.__v?(u.__k=t.__k,u.__e=t.__e):u.__e=z(t.__e,u,t,i,o,r,f,c,s);(a=l.diffed)&&a(u)}function j(n,u,t){u.__d=void 0;for(var i=0;i<t.length;i++)N(t[i],t[++i],t[++i]);l.__c&&l.__c(u,n),n.some(function(u){try{n=u.__h,u.__h=[],n.some(function(n){n.call(u)})}catch(n){l.__e(n,u.__v)}})}function z(l,u,t,i,o,r,f,e,c){var s,a,p,v,d,_,g,m=t.props,k=u.props,b=u.type;if("svg"===b?o="http://www.w3.org/2000/svg":"math"===b?o="http://www.w3.org/1998/Math/MathML":o||(o="http://www.w3.org/1999/xhtml"),null!=r)for(s=0;s<r.length;s++)if((d=r[s])&&"setAttribute"in d==!!b&&(b?d.localName===b:3===d.nodeType)){l=d,r[s]=null;break}if(null==l){if(null===b)return document.createTextNode(k);l=document.createElementNS(o,b,k.is&&k),r=null,e=!1}if(null===b)m===k||e&&l.data===k||(l.data=k);else{if(r=r&&n.call(l.childNodes),m=t.props||h,!e&&null!=r)for(m={},s=0;s<l.attributes.length;s++)m[(d=l.attributes[s]).name]=d.value;for(s in m)if(d=m[s],"children"==s);else if("dangerouslySetInnerHTML"==s)p=d;else if("key"!==s&&!(s in k)){if("value"==s&&"defaultValue"in k||"checked"==s&&"defaultChecked"in k)continue;A(l,s,null,d,o)}for(s in k)d=k[s],"children"==s?v=d:"dangerouslySetInnerHTML"==s?a=d:"value"==s?_=d:"checked"==s?g=d:"key"===s||e&&"function"!=typeof d||m[s]===d||A(l,s,d,m[s],o);if(a)e||p&&(a.__html===p.__html||a.__html===l.innerHTML)||(l.innerHTML=a.__html),u.__k=[];else if(p&&(l.innerHTML=""),S(l,y(v)?v:[v],u,t,i,"foreignObject"===b?"http://www.w3.org/1999/xhtml":o,r,f,r?r[0]:t.__k&&x(t,0),e,c),null!=r)for(s=r.length;s--;)null!=r[s]&&w(r[s]);e||(s="value",void 0!==_&&(_!==l[s]||"progress"===b&&!_||"option"===b&&_!==m[s])&&A(l,s,_,m[s],o),s="checked",void 0!==g&&g!==l[s]&&A(l,s,g,m[s],o))}return l}function N(n,u,t){try{"function"==typeof n?n(u):n.current=u}catch(n){l.__e(n,t)}}function V(n,u,t){var i,o;if(l.unmount&&l.unmount(n),(i=n.ref)&&(i.current&&i.current!==n.__e||N(i,null,u)),null!=(i=n.__c)){if(i.componentWillUnmount)try{i.componentWillUnmount()}catch(n){l.__e(n,u)}i.base=i.__P=null}if(i=n.__k)for(o=0;o<i.length;o++)i[o]&&V(i[o],u,t||"function"!=typeof n.type);t||null==n.__e||w(n.__e),n.__c=n.__=n.__e=n.__d=void 0}function q(n,l,u){return this.constructor(n,u)}function B(u,t,i){var o,r,f,e;l.__&&l.__(u,t),r=(o="function"==typeof i)?null:i&&i.__k||t.__k,f=[],e=[],O(t,u=(!o&&i||t).__k=_(k,null,[u]),r||h,h,t.namespaceURI,!o&&i?[i]:r?null:t.firstChild?n.call(t.childNodes):null,f,!o&&i?i:r?r.__e:t.firstChild,o,e),j(f,u,e)}function D(n,l){B(n,l,D)}function E(l,u,t){var i,o,r,f,e=d({},l.props);for(r in l.type&&l.type.defaultProps&&(f=l.type.defaultProps),u)"key"==r?i=u[r]:"ref"==r?o=u[r]:e[r]=void 0===u[r]&&void 0!==f?f[r]:u[r];return arguments.length>2&&(e.children=arguments.length>3?n.call(arguments,2):t),g(l.type,e,i||l.key,o||l.ref,null)}function G(n,l){var u={__c:l="__cC"+a++,__:n,Consumer:function(n,l){return n.children(l)},Provider:function(n){var u,t;return this.getChildContext||(u=[],(t={})[l]=this,this.getChildContext=function(){return t},this.componentWillUnmount=function(){u=null},this.shouldComponentUpdate=function(n){this.props.value!==n.value&&u.some(function(n){n.__e=!0,M(n)})},this.sub=function(n){u.push(n);var l=n.componentWillUnmount;n.componentWillUnmount=function(){u&&u.splice(u.indexOf(n),1),l&&l.call(n)}}),n.children}};return u.Provider.__=u.Consumer.contextType=u}n=p.slice,l={__e:function(n,l,u,t){for(var i,o,r;l=l.__;)if((i=l.__c)&&!i.__)try{if((o=i.constructor)&&null!=o.getDerivedStateFromError&&(i.setState(o.getDerivedStateFromError(n)),r=i.__d),null!=i.componentDidCatch&&(i.componentDidCatch(n,t||{}),r=i.__d),r)return i.__E=i}catch(l){n=l}throw n}},u=0,t=function(n){return null!=n&&null==n.constructor},b.prototype.setState=function(n,l){var u;u=null!=this.__s&&this.__s!==this.state?this.__s:this.__s=d({},this.state),"function"==typeof n&&(n=n(d({},u),this.props)),n&&d(u,n),null!=n&&this.__v&&(l&&this._sb.push(l),M(this))},b.prototype.forceUpdate=function(n){this.__v&&(this.__e=!0,n&&this.__h.push(n),M(this))},b.prototype.render=k,i=[],r="function"==typeof Promise?Promise.prototype.then.bind(Promise.resolve()):setTimeout,f=function(n,l){return n.__v.__b-l.__v.__b},P.__r=0,e=0,c=F(!1),s=F(!0),a=0;
//# sourceMappingURL=preact.module.js.map


/***/ }),

/***/ "../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js":
/*!***********************************************************************!*\
  !*** ../omnipress-pro/node_modules/preact/hooks/dist/hooks.module.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   useCallback: () => (/* binding */ q),
/* harmony export */   useContext: () => (/* binding */ x),
/* harmony export */   useDebugValue: () => (/* binding */ P),
/* harmony export */   useEffect: () => (/* binding */ y),
/* harmony export */   useErrorBoundary: () => (/* binding */ b),
/* harmony export */   useId: () => (/* binding */ g),
/* harmony export */   useImperativeHandle: () => (/* binding */ F),
/* harmony export */   useLayoutEffect: () => (/* binding */ _),
/* harmony export */   useMemo: () => (/* binding */ T),
/* harmony export */   useReducer: () => (/* binding */ p),
/* harmony export */   useRef: () => (/* binding */ A),
/* harmony export */   useState: () => (/* binding */ h)
/* harmony export */ });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "../omnipress-pro/node_modules/preact/dist/preact.module.js");
var t,r,u,i,o=0,f=[],c=preact__WEBPACK_IMPORTED_MODULE_0__.options,e=c.__b,a=c.__r,v=c.diffed,l=c.__c,m=c.unmount,s=c.__;function d(n,t){c.__h&&c.__h(r,n,o||t),o=0;var u=r.__H||(r.__H={__:[],__h:[]});return n>=u.__.length&&u.__.push({}),u.__[n]}function h(n){return o=1,p(D,n)}function p(n,u,i){var o=d(t++,2);if(o.t=n,!o.__c&&(o.__=[i?i(u):D(void 0,u),function(n){var t=o.__N?o.__N[0]:o.__[0],r=o.t(t,n);t!==r&&(o.__N=[r,o.__[1]],o.__c.setState({}))}],o.__c=r,!r.u)){var f=function(n,t,r){if(!o.__c.__H)return!0;var u=o.__c.__H.__.filter(function(n){return!!n.__c});if(u.every(function(n){return!n.__N}))return!c||c.call(this,n,t,r);var i=!1;return u.forEach(function(n){if(n.__N){var t=n.__[0];n.__=n.__N,n.__N=void 0,t!==n.__[0]&&(i=!0)}}),!(!i&&o.__c.props===n)&&(!c||c.call(this,n,t,r))};r.u=!0;var c=r.shouldComponentUpdate,e=r.componentWillUpdate;r.componentWillUpdate=function(n,t,r){if(this.__e){var u=c;c=void 0,f(n,t,r),c=u}e&&e.call(this,n,t,r)},r.shouldComponentUpdate=f}return o.__N||o.__}function y(n,u){var i=d(t++,3);!c.__s&&C(i.__H,u)&&(i.__=n,i.i=u,r.__H.__h.push(i))}function _(n,u){var i=d(t++,4);!c.__s&&C(i.__H,u)&&(i.__=n,i.i=u,r.__h.push(i))}function A(n){return o=5,T(function(){return{current:n}},[])}function F(n,t,r){o=6,_(function(){return"function"==typeof n?(n(t()),function(){return n(null)}):n?(n.current=t(),function(){return n.current=null}):void 0},null==r?r:r.concat(n))}function T(n,r){var u=d(t++,7);return C(u.__H,r)&&(u.__=n(),u.__H=r,u.__h=n),u.__}function q(n,t){return o=8,T(function(){return n},t)}function x(n){var u=r.context[n.__c],i=d(t++,9);return i.c=n,u?(null==i.__&&(i.__=!0,u.sub(r)),u.props.value):n.__}function P(n,t){c.useDebugValue&&c.useDebugValue(t?t(n):n)}function b(n){var u=d(t++,10),i=h();return u.__=n,r.componentDidCatch||(r.componentDidCatch=function(n,t){u.__&&u.__(n,t),i[1](n)}),[i[0],function(){i[1](void 0)}]}function g(){var n=d(t++,11);if(!n.__){for(var u=r.__v;null!==u&&!u.__m&&null!==u.__;)u=u.__;var i=u.__m||(u.__m=[0,0]);n.__="P"+i[0]+"-"+i[1]++}return n.__}function j(){for(var n;n=f.shift();)if(n.__P&&n.__H)try{n.__H.__h.forEach(z),n.__H.__h.forEach(B),n.__H.__h=[]}catch(t){n.__H.__h=[],c.__e(t,n.__v)}}c.__b=function(n){r=null,e&&e(n)},c.__=function(n,t){n&&t.__k&&t.__k.__m&&(n.__m=t.__k.__m),s&&s(n,t)},c.__r=function(n){a&&a(n),t=0;var i=(r=n.__c).__H;i&&(u===r?(i.__h=[],r.__h=[],i.__.forEach(function(n){n.__N&&(n.__=n.__N),n.i=n.__N=void 0})):(i.__h.forEach(z),i.__h.forEach(B),i.__h=[],t=0)),u=r},c.diffed=function(n){v&&v(n);var t=n.__c;t&&t.__H&&(t.__H.__h.length&&(1!==f.push(t)&&i===c.requestAnimationFrame||((i=c.requestAnimationFrame)||w)(j)),t.__H.__.forEach(function(n){n.i&&(n.__H=n.i),n.i=void 0})),u=r=null},c.__c=function(n,t){t.some(function(n){try{n.__h.forEach(z),n.__h=n.__h.filter(function(n){return!n.__||B(n)})}catch(r){t.some(function(n){n.__h&&(n.__h=[])}),t=[],c.__e(r,n.__v)}}),l&&l(n,t)},c.unmount=function(n){m&&m(n);var t,r=n.__c;r&&r.__H&&(r.__H.__.forEach(function(n){try{z(n)}catch(n){t=n}}),r.__H=void 0,t&&c.__e(t,r.__v))};var k="function"==typeof requestAnimationFrame;function w(n){var t,r=function(){clearTimeout(u),k&&cancelAnimationFrame(t),setTimeout(n)},u=setTimeout(r,100);k&&(t=requestAnimationFrame(r))}function z(n){var t=r,u=n.__c;"function"==typeof u&&(n.__c=void 0,u()),r=t}function B(n){var t=r;n.__c=n.__(),r=t}function C(n,t){return!n||n.length!==t.length||t.some(function(t,r){return t!==n[r]})}function D(n,t){return"function"==typeof t?t(n):t}
//# sourceMappingURL=hooks.module.js.map


/***/ }),

/***/ "../omnipress-pro/node_modules/@babel/runtime/helpers/regeneratorRuntime.js":
/*!**********************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@babel/runtime/helpers/regeneratorRuntime.js ***!
  \**********************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _typeof = (__webpack_require__(/*! ./typeof.js */ "../omnipress-pro/node_modules/@babel/runtime/helpers/typeof.js")["default"]);
function _regeneratorRuntime() {
  "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */
  module.exports = _regeneratorRuntime = function _regeneratorRuntime() {
    return exports;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports;
  var exports = {},
    Op = Object.prototype,
    hasOwn = Op.hasOwnProperty,
    defineProperty = Object.defineProperty || function (obj, key, desc) {
      obj[key] = desc.value;
    },
    $Symbol = "function" == typeof Symbol ? Symbol : {},
    iteratorSymbol = $Symbol.iterator || "@@iterator",
    asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator",
    toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";
  function define(obj, key, value) {
    return Object.defineProperty(obj, key, {
      value: value,
      enumerable: !0,
      configurable: !0,
      writable: !0
    }), obj[key];
  }
  try {
    define({}, "");
  } catch (err) {
    define = function define(obj, key, value) {
      return obj[key] = value;
    };
  }
  function wrap(innerFn, outerFn, self, tryLocsList) {
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator,
      generator = Object.create(protoGenerator.prototype),
      context = new Context(tryLocsList || []);
    return defineProperty(generator, "_invoke", {
      value: makeInvokeMethod(innerFn, self, context)
    }), generator;
  }
  function tryCatch(fn, obj, arg) {
    try {
      return {
        type: "normal",
        arg: fn.call(obj, arg)
      };
    } catch (err) {
      return {
        type: "throw",
        arg: err
      };
    }
  }
  exports.wrap = wrap;
  var ContinueSentinel = {};
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}
  var IteratorPrototype = {};
  define(IteratorPrototype, iteratorSymbol, function () {
    return this;
  });
  var getProto = Object.getPrototypeOf,
    NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype);
  var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype);
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function (method) {
      define(prototype, method, function (arg) {
        return this._invoke(method, arg);
      });
    });
  }
  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if ("throw" !== record.type) {
        var result = record.arg,
          value = result.value;
        return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) {
          invoke("next", value, resolve, reject);
        }, function (err) {
          invoke("throw", err, resolve, reject);
        }) : PromiseImpl.resolve(value).then(function (unwrapped) {
          result.value = unwrapped, resolve(result);
        }, function (error) {
          return invoke("throw", error, resolve, reject);
        });
      }
      reject(record.arg);
    }
    var previousPromise;
    defineProperty(this, "_invoke", {
      value: function value(method, arg) {
        function callInvokeWithMethodAndArg() {
          return new PromiseImpl(function (resolve, reject) {
            invoke(method, arg, resolve, reject);
          });
        }
        return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg();
      }
    });
  }
  function makeInvokeMethod(innerFn, self, context) {
    var state = "suspendedStart";
    return function (method, arg) {
      if ("executing" === state) throw new Error("Generator is already running");
      if ("completed" === state) {
        if ("throw" === method) throw arg;
        return doneResult();
      }
      for (context.method = method, context.arg = arg;;) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }
        if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) {
          if ("suspendedStart" === state) throw state = "completed", context.arg;
          context.dispatchException(context.arg);
        } else "return" === context.method && context.abrupt("return", context.arg);
        state = "executing";
        var record = tryCatch(innerFn, self, context);
        if ("normal" === record.type) {
          if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue;
          return {
            value: record.arg,
            done: context.done
          };
        }
        "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg);
      }
    };
  }
  function maybeInvokeDelegate(delegate, context) {
    var methodName = context.method,
      method = delegate.iterator[methodName];
    if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel;
    var record = tryCatch(method, delegate.iterator, context.arg);
    if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel;
    var info = record.arg;
    return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel);
  }
  function pushTryEntry(locs) {
    var entry = {
      tryLoc: locs[0]
    };
    1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry);
  }
  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal", delete record.arg, entry.completion = record;
  }
  function Context(tryLocsList) {
    this.tryEntries = [{
      tryLoc: "root"
    }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0);
  }
  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) return iteratorMethod.call(iterable);
      if ("function" == typeof iterable.next) return iterable;
      if (!isNaN(iterable.length)) {
        var i = -1,
          next = function next() {
            for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next;
            return next.value = undefined, next.done = !0, next;
          };
        return next.next = next;
      }
    }
    return {
      next: doneResult
    };
  }
  function doneResult() {
    return {
      value: undefined,
      done: !0
    };
  }
  return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", {
    value: GeneratorFunctionPrototype,
    configurable: !0
  }), defineProperty(GeneratorFunctionPrototype, "constructor", {
    value: GeneratorFunction,
    configurable: !0
  }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) {
    var ctor = "function" == typeof genFun && genFun.constructor;
    return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name));
  }, exports.mark = function (genFun) {
    return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun;
  }, exports.awrap = function (arg) {
    return {
      __await: arg
    };
  }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
    return this;
  }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    void 0 === PromiseImpl && (PromiseImpl = Promise);
    var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl);
    return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) {
      return result.done ? result.value : iter.next();
    });
  }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () {
    return this;
  }), define(Gp, "toString", function () {
    return "[object Generator]";
  }), exports.keys = function (val) {
    var object = Object(val),
      keys = [];
    for (var key in object) keys.push(key);
    return keys.reverse(), function next() {
      for (; keys.length;) {
        var key = keys.pop();
        if (key in object) return next.value = key, next.done = !1, next;
      }
      return next.done = !0, next;
    };
  }, exports.values = values, Context.prototype = {
    constructor: Context,
    reset: function reset(skipTempReset) {
      if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined);
    },
    stop: function stop() {
      this.done = !0;
      var rootRecord = this.tryEntries[0].completion;
      if ("throw" === rootRecord.type) throw rootRecord.arg;
      return this.rval;
    },
    dispatchException: function dispatchException(exception) {
      if (this.done) throw exception;
      var context = this;
      function handle(loc, caught) {
        return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught;
      }
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i],
          record = entry.completion;
        if ("root" === entry.tryLoc) return handle("end");
        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc"),
            hasFinally = hasOwn.call(entry, "finallyLoc");
          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
            if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
          } else {
            if (!hasFinally) throw new Error("try statement without catch or finally");
            if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
          }
        }
      }
    },
    abrupt: function abrupt(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }
      finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null);
      var record = finallyEntry ? finallyEntry.completion : {};
      return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record);
    },
    complete: function complete(record, afterLoc) {
      if ("throw" === record.type) throw record.arg;
      return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel;
    },
    finish: function finish(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel;
      }
    },
    "catch": function _catch(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if ("throw" === record.type) {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }
      throw new Error("illegal catch attempt");
    },
    delegateYield: function delegateYield(iterable, resultName, nextLoc) {
      return this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      }, "next" === this.method && (this.arg = undefined), ContinueSentinel;
    }
  }, exports;
}
module.exports = _regeneratorRuntime, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "../omnipress-pro/node_modules/@babel/runtime/helpers/typeof.js":
/*!**********************************************************************!*\
  !*** ../omnipress-pro/node_modules/@babel/runtime/helpers/typeof.js ***!
  \**********************************************************************/
/***/ ((module) => {

function _typeof(obj) {
  "@babel/helpers - typeof";

  return (module.exports = _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
    return typeof obj;
  } : function (obj) {
    return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports), _typeof(obj);
}
module.exports = _typeof, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ "../omnipress-pro/node_modules/@babel/runtime/regenerator/index.js":
/*!*************************************************************************!*\
  !*** ../omnipress-pro/node_modules/@babel/runtime/regenerator/index.js ***!
  \*************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

// TODO(Babel 8): Remove this file.

var runtime = __webpack_require__(/*! ../helpers/regeneratorRuntime */ "../omnipress-pro/node_modules/@babel/runtime/helpers/regeneratorRuntime.js")();
module.exports = runtime;

// Copied from https://github.com/facebook/regenerator/blob/main/packages/runtime/runtime.js#L736=
try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/async module */
/******/ 	(() => {
/******/ 		var webpackQueues = typeof Symbol === "function" ? Symbol("webpack queues") : "__webpack_queues__";
/******/ 		var webpackExports = typeof Symbol === "function" ? Symbol("webpack exports") : "__webpack_exports__";
/******/ 		var webpackError = typeof Symbol === "function" ? Symbol("webpack error") : "__webpack_error__";
/******/ 		var resolveQueue = (queue) => {
/******/ 			if(queue && queue.d < 1) {
/******/ 				queue.d = 1;
/******/ 				queue.forEach((fn) => (fn.r--));
/******/ 				queue.forEach((fn) => (fn.r-- ? fn.r++ : fn()));
/******/ 			}
/******/ 		}
/******/ 		var wrapDeps = (deps) => (deps.map((dep) => {
/******/ 			if(dep !== null && typeof dep === "object") {
/******/ 				if(dep[webpackQueues]) return dep;
/******/ 				if(dep.then) {
/******/ 					var queue = [];
/******/ 					queue.d = 0;
/******/ 					dep.then((r) => {
/******/ 						obj[webpackExports] = r;
/******/ 						resolveQueue(queue);
/******/ 					}, (e) => {
/******/ 						obj[webpackError] = e;
/******/ 						resolveQueue(queue);
/******/ 					});
/******/ 					var obj = {};
/******/ 					obj[webpackQueues] = (fn) => (fn(queue));
/******/ 					return obj;
/******/ 				}
/******/ 			}
/******/ 			var ret = {};
/******/ 			ret[webpackQueues] = x => {};
/******/ 			ret[webpackExports] = dep;
/******/ 			return ret;
/******/ 		}));
/******/ 		__webpack_require__.a = (module, body, hasAwait) => {
/******/ 			var queue;
/******/ 			hasAwait && ((queue = []).d = -1);
/******/ 			var depQueues = new Set();
/******/ 			var exports = module.exports;
/******/ 			var currentDeps;
/******/ 			var outerResolve;
/******/ 			var reject;
/******/ 			var promise = new Promise((resolve, rej) => {
/******/ 				reject = rej;
/******/ 				outerResolve = resolve;
/******/ 			});
/******/ 			promise[webpackExports] = exports;
/******/ 			promise[webpackQueues] = (fn) => (queue && fn(queue), depQueues.forEach(fn), promise["catch"](x => {}));
/******/ 			module.exports = promise;
/******/ 			body((deps) => {
/******/ 				currentDeps = wrapDeps(deps);
/******/ 				var fn;
/******/ 				var getResult = () => (currentDeps.map((d) => {
/******/ 					if(d[webpackError]) throw d[webpackError];
/******/ 					return d[webpackExports];
/******/ 				}))
/******/ 				var promise = new Promise((resolve) => {
/******/ 					fn = () => (resolve(getResult));
/******/ 					fn.r = 0;
/******/ 					var fnQueue = (q) => (q !== queue && !depQueues.has(q) && (depQueues.add(q), q && !q.d && (fn.r++, q.push(fn))));
/******/ 					currentDeps.map((dep) => (dep[webpackQueues](fnQueue)));
/******/ 				});
/******/ 				return fn.r ? promise : getResult();
/******/ 			}, (err) => ((err ? reject(promise[webpackError] = err) : outerResolve(exports)), resolveQueue(queue)));
/******/ 			queue && queue.d < 0 && (queue.d = 0);
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/ensure chunk */
/******/ 	(() => {
/******/ 		__webpack_require__.f = {};
/******/ 		// This file contains only the entry chunk.
/******/ 		// The chunk loading function for additional chunks
/******/ 		__webpack_require__.e = (chunkId) => {
/******/ 			return Promise.all(Object.keys(__webpack_require__.f).reduce((promises, key) => {
/******/ 				__webpack_require__.f[key](chunkId, promises);
/******/ 				return promises;
/******/ 			}, []));
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/get javascript chunk filename */
/******/ 	(() => {
/******/ 		// This function allow to reference async chunks
/******/ 		__webpack_require__.u = (chunkId) => {
/******/ 			// return url for filenames based on template
/******/ 			return "" + chunkId + "";
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/load script */
/******/ 	(() => {
/******/ 		var inProgress = {};
/******/ 		var dataWebpackPrefix = "omnipress:";
/******/ 		// loadScript function to load a script via script tag
/******/ 		__webpack_require__.l = (url, done, key, chunkId) => {
/******/ 			if(inProgress[url]) { inProgress[url].push(done); return; }
/******/ 			var script, needAttach;
/******/ 			if(key !== undefined) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				for(var i = 0; i < scripts.length; i++) {
/******/ 					var s = scripts[i];
/******/ 					if(s.getAttribute("src") == url || s.getAttribute("data-webpack") == dataWebpackPrefix + key) { script = s; break; }
/******/ 				}
/******/ 			}
/******/ 			if(!script) {
/******/ 				needAttach = true;
/******/ 				script = document.createElement('script');
/******/ 		
/******/ 				script.charset = 'utf-8';
/******/ 				script.timeout = 120;
/******/ 				if (__webpack_require__.nc) {
/******/ 					script.setAttribute("nonce", __webpack_require__.nc);
/******/ 				}
/******/ 				script.setAttribute("data-webpack", dataWebpackPrefix + key);
/******/ 		
/******/ 				script.src = url;
/******/ 			}
/******/ 			inProgress[url] = [done];
/******/ 			var onScriptComplete = (prev, event) => {
/******/ 				// avoid mem leaks in IE.
/******/ 				script.onerror = script.onload = null;
/******/ 				clearTimeout(timeout);
/******/ 				var doneFns = inProgress[url];
/******/ 				delete inProgress[url];
/******/ 				script.parentNode && script.parentNode.removeChild(script);
/******/ 				doneFns && doneFns.forEach((fn) => (fn(event)));
/******/ 				if(prev) return prev(event);
/******/ 			}
/******/ 			var timeout = setTimeout(onScriptComplete.bind(null, undefined, { type: 'timeout', target: script }), 120000);
/******/ 			script.onerror = onScriptComplete.bind(null, script.onerror);
/******/ 			script.onload = onScriptComplete.bind(null, script.onload);
/******/ 			needAttach && document.head.appendChild(script);
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	(() => {
/******/ 		var scriptUrl;
/******/ 		if (__webpack_require__.g.importScripts) scriptUrl = __webpack_require__.g.location + "";
/******/ 		var document = __webpack_require__.g.document;
/******/ 		if (!scriptUrl && document) {
/******/ 			if (document.currentScript)
/******/ 				scriptUrl = document.currentScript.src;
/******/ 			if (!scriptUrl) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				if(scripts.length) {
/******/ 					var i = scripts.length - 1;
/******/ 					while (i > -1 && (!scriptUrl || !/^http(s?):/.test(scriptUrl))) scriptUrl = scripts[i--].src;
/******/ 				}
/******/ 			}
/******/ 		}
/******/ 		// When supporting browsers where an automatic publicPath is not supported you must specify an output.publicPath manually via configuration
/******/ 		// or pass an empty string ("") and set the __webpack_public_path__ variable from your code to use your own logic.
/******/ 		if (!scriptUrl) throw new Error("Automatic publicPath is not supported in this browser");
/******/ 		scriptUrl = scriptUrl.replace(/#.*$/, "").replace(/\?.*$/, "").replace(/\/[^\/]+$/, "/");
/******/ 		__webpack_require__.p = scriptUrl;
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"query-view-module.js": 0
/******/ 		};
/******/ 		
/******/ 		__webpack_require__.f.j = (chunkId, promises) => {
/******/ 				// JSONP chunk loading for javascript
/******/ 				var installedChunkData = __webpack_require__.o(installedChunks, chunkId) ? installedChunks[chunkId] : undefined;
/******/ 				if(installedChunkData !== 0) { // 0 means "already installed".
/******/ 		
/******/ 					// a Promise means "currently loading".
/******/ 					if(installedChunkData) {
/******/ 						promises.push(installedChunkData[2]);
/******/ 					} else {
/******/ 						if(true) { // all chunks have JS
/******/ 							// setup Promise in chunk cache
/******/ 							var promise = new Promise((resolve, reject) => (installedChunkData = installedChunks[chunkId] = [resolve, reject]));
/******/ 							promises.push(installedChunkData[2] = promise);
/******/ 		
/******/ 							// start chunk loading
/******/ 							var url = __webpack_require__.p + __webpack_require__.u(chunkId);
/******/ 							// create error before stack unwound to get useful stacktrace later
/******/ 							var error = new Error();
/******/ 							var loadingEnded = (event) => {
/******/ 								if(__webpack_require__.o(installedChunks, chunkId)) {
/******/ 									installedChunkData = installedChunks[chunkId];
/******/ 									if(installedChunkData !== 0) installedChunks[chunkId] = undefined;
/******/ 									if(installedChunkData) {
/******/ 										var errorType = event && (event.type === 'load' ? 'missing' : event.type);
/******/ 										var realSrc = event && event.target && event.target.src;
/******/ 										error.message = 'Loading chunk ' + chunkId + ' failed.\n(' + errorType + ': ' + realSrc + ')';
/******/ 										error.name = 'ChunkLoadError';
/******/ 										error.type = errorType;
/******/ 										error.request = realSrc;
/******/ 										installedChunkData[1](error);
/******/ 									}
/******/ 								}
/******/ 							};
/******/ 							__webpack_require__.l(url, loadingEnded, "chunk-" + chunkId, chunkId);
/******/ 						}
/******/ 					}
/******/ 				}
/******/ 		};
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		// no on chunks loaded
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 		
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = globalThis["webpackChunkomnipress"] = globalThis["webpackChunkomnipress"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!****************************************************************************!*\
  !*** ../omnipress-pro/src/blocks/advanced-query-loop/query-view-module.js ***!
  \****************************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "../omnipress-pro/node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/interactivity */ "../omnipress-pro/node_modules/@wordpress/interactivity/build-module/index.js");


(0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.store)('omnipress/query', {
  actions: {
    navigate: /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function navigate(event) {
      var _queryRef$querySelect;
      var ctx, _getElement, ref, queryRef, _yield$import, actions, firstAnchor;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function navigate$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            ctx = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.getContext)();
            _getElement = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.getElement)(), ref = _getElement.ref;
            queryRef = ref.closest('.wp-block-omnipress-query-loop');
            event.preventDefault();
            _context.next = 6;
            return __webpack_require__.e(/*! import() */ "vendors-omnipress-pro_node_modules_wordpress_interactivity-router_build-module_index_js").then(__webpack_require__.bind(__webpack_require__, /*! @wordpress/interactivity-router */ "../omnipress-pro/node_modules/@wordpress/interactivity-router/build-module/index.js"));
          case 6:
            _yield$import = _context.sent;
            actions = _yield$import.actions;
            _context.next = 10;
            return actions.navigate(ref.href);
          case 10:
            ctx.url = ref.href;

            // Focus the first anchor of the Query block.
            firstAnchor = ".wp-block-omnipress-query-template a[href]";
            (_queryRef$querySelect = queryRef.querySelector(firstAnchor)) === null || _queryRef$querySelect === void 0 || _queryRef$querySelect.focus();
          case 13:
          case "end":
            return _context.stop();
        }
      }, navigate);
    }),
    prefetch: /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function prefetch() {
      var _getElement2, ref, _yield$import2, actions;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function prefetch$(_context2) {
        while (1) switch (_context2.prev = _context2.next) {
          case 0:
            _getElement2 = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.getElement)(), ref = _getElement2.ref;
            console.log(ref, 'ref');
            _context2.next = 4;
            return __webpack_require__.e(/*! import() */ "vendors-omnipress-pro_node_modules_wordpress_interactivity-router_build-module_index_js").then(__webpack_require__.bind(__webpack_require__, /*! @wordpress/interactivity-router */ "../omnipress-pro/node_modules/@wordpress/interactivity-router/build-module/index.js"));
          case 4:
            _yield$import2 = _context2.sent;
            actions = _yield$import2.actions;
            _context2.next = 8;
            return actions.prefetch(ref.href);
          case 8:
          case "end":
            return _context2.stop();
        }
      }, prefetch);
    }),
    isOpen: function isOpen() {
      var context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.getContext)();
      console.log(context);
      context.isOpen = !context.isOpen;
    }
  },
  callbacks: {
    prefetch: /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function prefetch() {
      var _getContext, url, _getElement3, ref, _yield$import3, actions;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function prefetch$(_context3) {
        while (1) switch (_context3.prev = _context3.next) {
          case 0:
            _getContext = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.getContext)(), url = _getContext.url;
            _getElement3 = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.getElement)(), ref = _getElement3.ref;
            _context3.next = 4;
            return __webpack_require__.e(/*! import() */ "vendors-omnipress-pro_node_modules_wordpress_interactivity-router_build-module_index_js").then(__webpack_require__.bind(__webpack_require__, /*! @wordpress/interactivity-router */ "../omnipress-pro/node_modules/@wordpress/interactivity-router/build-module/index.js"));
          case 4:
            _yield$import3 = _context3.sent;
            actions = _yield$import3.actions;
            _context3.next = 8;
            return actions.prefetch(ref.href);
          case 8:
          case "end":
            return _context3.stop();
        }
      }, prefetch);
    }),
    logIsOpen: function logIsOpen() {
      var context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_1__.getContext)();
      console.log("Is open: ".concat(context.isOpen));
    }
  }
}, {
  lock: true
});
})();

/******/ })()
;
//# sourceMappingURL=query-view-module.js.map