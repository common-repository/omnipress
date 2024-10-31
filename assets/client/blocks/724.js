"use strict";(globalThis.webpackChunkomnipress=globalThis.webpackChunkomnipress||[]).push([[724],{5724:(e,t,o)=>{o.r(t),o.d(t,{default:()=>l});var n=o(9196),i=o(9307),a=o(1370),r=o(2423),c=o(1168),s=o(1775);const l=(0,i.memo)((function({attributes:e,setAttributes:t}){const{durationStartDate:o,countdownDuration:l,countdownType:d,isSeparator:u,separatorType:m,timezone:p}=e,[b,g]=(0,i.useState)(0);let v=[];if((0,i.useEffect)((()=>{const{isStarted:n,remainingTime:i}=(0,r.bE)(null!=o?o:a.ou.now().toISO(),null!=l?l:{days:1},p);let c,s;return n?(c=i.milliseconds,e.isPreview&&(s=setInterval((()=>{if(b<=0){const{isStarted:e,remainingTime:t}=(0,r.bE)(null!=o?o:a.ou.now().toISO(),null!=l?l:{days:1});g(t.milliseconds)}else g((e=>e-1e3))}),1e3),setTimeout((()=>{t({isPreview:!1}),clearInterval(s)}),5e3)),t({isCountdownStart:n}),g(c),"rec"===d?()=>{clearInterval(s)}:void clearInterval(s)):(t({messageAfterExpiration:"Starts in : "}),t({isCountdownStart:!1}),t({isPreview:!1}),void(s&&clearInterval(s)))}),[l,o,e.isPreview,p]),v=(0,r.ER)(b),v.length>0)return v.length>0&&v.map(((o,i)=>(0,n.createElement)(n.Fragment,null,(0,n.createElement)(c.Z,{digit:o.digit,digitType:o.digitType,attributes:e,setAttributes:t,key:o.digitType}),i<v.length-1&&u?(0,n.createElement)(s.Z,{key:`${i}separator`,separatorType:m}):"")))}))},1168:(e,t,o)=>{o.d(t,{Z:()=>a});var n=o(9196),i=o(2175);const a=(0,o(9307).memo)((function({attributes:e,setAttributes:t,digit:o=0,digitType:a="Hours"}){var r,c;return(0,n.createElement)("div",{className:"op-block-countdown__content-container op-block__content-container"},e.contentContainer.backgroundImage&&(0,n.createElement)("div",{className:"op-content-container--has-overlay op-block--has-overlay",style:{opacity:Number.isNaN(e.contentContainer.bgOverlayOpacity)?.5:e.contentContainer.bgOverlayOpacity/10,backgroundColor:null!==(r=e.contentContainer.backgroundColor)&&void 0!==r?r:"#0005"}}),e.contentContainer.backgroundImage&&e.contentContainer.backgroundImage.includes(".mp4")?(0,n.createElement)("video",{className:"op-content-container--has-video-overlay op-block--has-video-overlay",style:{objectFit:e.contentContainer.backgroundSize||"contain"},muted:!0,loop:!0,autoPlay:!0},(0,n.createElement)("source",{src:e.contentContainer.backgroundImage,type:"video/mp4"})):"",(0,n.createElement)("div",{className:"op-block-countdown__content-wrapper"},(0,n.createElement)("div",{className:`op-block-countdown__digit op-block__countdown-digits op-block-countdown__digit-${a.toLowerCase()} has-text-color`},o),e.isLabel&&(0,n.createElement)(i.RichText,{className:"op-block-countdown__label-minute op-block-countdown__label op-block__countdown-label",onChange:o=>(o=>{if(o?.toLowerCase()===a.toLowerCase()){const o={...e.digitType};delete o[a.toLowerCase()],t({digitType:{...o}})}else t({digitType:{...e.digitType,[a.toLowerCase()]:o}})})(o),value:null!==(c=e.digitType[a.toLowerCase()])&&void 0!==c?c:a,tagName:"p"})))}))},1775:(e,t,o)=>{o.d(t,{Z:()=>i});var n=o(9196);const i=(0,o(9307).memo)((function({separatorType:e="colon"}){return(0,n.createElement)("div",{className:"op-block-countdown__divider-wrapper"},"colon"===e?(0,n.createElement)("div",{className:"op-block-countdown__divider-colon op-block__divider"}," ",":"," "):(0,n.createElement)("div",{className:"op-block-countdown__divider-line op-block__divider"}))}))},2423:(e,t,o)=>{o.d(t,{ER:()=>r,bE:()=>i,ok:()=>a});var n=o(1370);const i=(e,t,o="UTC")=>{!Object.values(t).every((e=>0===e))&&Object.keys(t).length||(t={days:1,hours:23,minutes:59,seconds:59});const i=n.ou.now();e||(e=i.toISO()),o&&(e=n.ou.fromISO(e).setZone(o,{keepLocalTime:!0}).toString());const a=n.ou.fromISO(e).toMillis(),r=n.ou.fromISO(i).toMillis();let c,s=!1;const l=n.nL.fromObject(t).as("milliseconds");let d,u;return a>r?(s=!1,u=n.ou.fromISO(e).toFormat("x")-r):(c=i.diff(n.ou.fromISO(e)).toObject(),s=!0,d=c.milliseconds%l),d=n.nL.fromMillis(d).toObject(),d=n.nL.fromObject(d).shiftTo("days","hours","minutes","seconds").toObject(),d=n.nL.fromObject(t).minus(n.nL.fromObject(d)).shiftTo("milliseconds").toObject(),{remainingTime:d,isStarted:s,startsIn:u}};function a(e,t=""){const o=n.ou.now().toFormat("x");t&&(e=n.ou.fromISO(e).setZone(t,{keepLocalTime:!0}).toString());const i=n.ou.fromISO(e).toFormat("x")-o;return i<0?0:i}const r=e=>{const t=Math.floor(e/1e3),o=Math.floor(t/60),n=Math.floor(o/60);return[{digit:Math.floor(n/24),digitType:"Days"},{digit:n%24,digitType:"Hours"},{digit:o%60,digitType:"Minutes"},{digit:t%60,digitType:"Seconds"}]}}}]);