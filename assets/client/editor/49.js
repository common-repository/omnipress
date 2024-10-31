"use strict";(globalThis.webpackChunkomnipress=globalThis.webpackChunkomnipress||[]).push([[49],{9049:(e,o,t)=>{t.r(o),t.d(o,{default:()=>y});var p=t(9196),r=t(8912),a=t(7611),l=t(3478),s=t(7364),n=t(6989),i=t.n(n),m=t(9307),c=t(5736),d=t(8193),u=t(3750),x=t(9583),h=t(5434),g=t(9352),b=t(9655);function y(){const[e,o]=(0,m.useState)({sync:!1,loading:!0}),[t,n]=(0,m.useState)({}),[y,v]=(0,m.useState)([]),[E,w]=(0,m.useState)(!0),[k,N]=(0,m.useState)(!1),_=async(t,p)=>{const r=await i()({path:t?"/omnipress/v1/demos?sync=true":p?`/omnipress/v1/demos?filter=${p}`:"/omnipress/v1/demos"});return n(r),v(r?.demos||[]),o(t?{...e,sync:!1}:{...e,loading:!1}),r};return(0,m.useEffect)((()=>{o({...e,loading:!0}),i()({path:"/omnipress/v1/demos"}).then((t=>{n(t),v(t?.demos||[]),o({...e,loading:!1})}))}),[]),(0,p.createElement)("div",{className:"op-flex op-items-start"},(0,p.createElement)(a.Z,{total:t?.total,openFilter:E,setOpenFilter:w,categories:t?.categories,onClick:e=>{N(!1),_(!1,e?.key||null)}}),(0,p.createElement)("div",{className:"demo-content-wrap op-flex-1 op-bg-white dark:op-bg-gray-800 op-h-full"},(0,p.createElement)("div",{className:"demos-content-header op-h-[60px] op-flex op-flex-wrap op-items-center op-justify-between op-border-b op-border-b-border op-px-6"},(0,p.createElement)("div",{className:"op-relative"},(0,p.createElement)("div",{className:"op-flex op-items-center op-gap-xxsmall"},!1===E?(0,p.createElement)(r.Z,{text:(0,c.__)("Filter by categories","omnipress"),position:"top"},(0,p.createElement)("button",{type:"button",onClick:()=>w(!E),className:" op-bg-primary hover:op-bg-primary/80 op-rounded-md op-w-8 op-h-8 op-flex op-justify-center op-items-center"},(0,p.createElement)(x.ulB,{className:"op-text-white"}))):(0,p.createElement)(r.Z,{text:(0,c.__)("Close filter","omnipress"),position:"top"},(0,p.createElement)("button",{type:"button",onClick:()=>w(!E),className:" op-bg-primary/10 op-text-black dark:op-bg-gray-900 hover:op-text-primary dark:op-text-light-text dark:hover:op-bg-primary op-flex op-justify-center op-items-center op-rounded-md op-w-8 op-h-8 op-duration-200"},(0,p.createElement)(d.kyg,{className:"op-w-6 op-h-5"}))),(0,p.createElement)(r.Z,{text:e.sync?(0,c.__)("Syncing","omnipress"):(0,c.__)("Sync library","omnipress"),position:"top"},(0,p.createElement)("button",{type:"button",disabled:!!e.sync,onClick:()=>{N(!1),o({...e,sync:!0}),_(!0)},className:"op-bg-primary/10 op-text-black dark:op-bg-gray-900 hover:op-text-primary dark:op-text-light-text dark:hover:op-bg-primary op-flex op-items-center op-justify-center op-rounded-md op-w-8 op-h-8 op-duration-200"},(0,p.createElement)(d.IDO,{className:e.sync?"op-w-5 op-h-5 op-animate-spin":"op-w-5 op-h-5"}))),(0,p.createElement)("div",{className:"pattern-count-wrap"},(0,p.createElement)("h2",{className:"op-font-poppins op-text-18 op-font-semibold dark:op-text-light-text"},k?(0,c.__)("Favorites","omnipress"):(0,c.__)("Demos","omnipress"))))),(0,p.createElement)("div",{className:"my-favorite-btn-wrap"},(0,p.createElement)("button",{type:"button",className:"op-bg-primary/10 dark:op-bg-gray-900 op-flex op-items-center op-gap-[5px] hover:op-text-primary dark:op-text-light-text dark:hover:op-bg-primary op-rounded-[5px] op-px-xxsmall op-py-[5px] op-duration-200",onClick:()=>{_().then((e=>{const o=k?e.demos:Object.values(e.favorites);v(o||[]),N(!k)}))}},k?(0,p.createElement)(u.KF7,{size:18}):(0,p.createElement)(h.Yqy,{size:18}),(0,p.createElement)("span",{className:"op-font-poppins op-font-normal"},k?(0,c.__)("View Demos","omnipress"):(0,c.__)("My Favorites","omnipress"))))),(0,p.createElement)("div",{className:"op-h-[calc(100vh-36vh)] op-relative op-p-6 op-overflow-hidden op-overflow-y-auto op-scrollbar-thin op-scrollbar-thumb-rounded-full op-scrollbar-track-rounded-full op-scrollbar-thumb-gray-500 op-scrollbar-track-gray-300"},(0,p.createElement)("div",{className:"demos-grid-wrap op-grid op-grid-cols-1 md:op-grid-cols-3 lg:op-grid-cols-3 op-gap-y-medium"},(0,p.createElement)(s.N,{className:"op-mx-6",isLoading:e.loading||e.sync,height:"20em",width:"10px"},y.length?y.map((e=>(0,p.createElement)("div",{key:e.key,className:"demos-item-wrap op-relative op-flex op-flex-wrap op-flex-col op-gap-xsmall op-justify-center op-items-center op-overflow-hidden op-group"},(0,p.createElement)(b.rU,{to:`${e.key}`,className:"demos-item-frame op-relative op-w-full op-flex op-justify-center focus:op-ring-0 op-group"},e.pages.map(((e,o)=>{if(o>2)return null;let t="";switch(o){case 1:t="op-w-[280px] op-h-[350px] op-rounded-[5px] op-m-0 op-p-0 op-overflow-hidden op-absolute op-top-xsmall op-left-xlarge group-hover:op-left-small op-opacity-50 group-hover:op-opacity-100 op-z-20 op-shadow-xl op-shadow-primary/20 op-rotate-0  op-duration-500";break;case 2:t="op-w-[280px] op-h-[350px] op-rounded-[5px] op-m-0 op-p-0 op-overflow-hidden op-absolute op-top-xsmall op-right-xlarge group-hover:op-right-small op-opacity-50 group-hover:op-opacity-100 op-z-10 op-shadow-xl op-shadow-primary/20 op-rotate-0  op-duration-500";break;default:t="op-w-[320px] op-h-[400px] op-rounded-[5px] op-m-0 op-p-0 op-overflow-hidden op-z-30 op-shadow-xl op-shadow-primary/20 op-rotate-0 group-hover:op-w-[260px] op-duration-500"}return(0,p.createElement)("div",{key:e.key,className:t},(0,p.createElement)(l.Z,{gradient:e.gradient,src:e.thumbnails.low,className:"op-width-auto op-object-cover"}))}))),(0,p.createElement)("div",{className:"demo-action-wrap op-flex op-items-center op-justify-center"},(0,p.createElement)(b.rU,{to:`/op-app/demos/${e.key}`,className:"op-font-poppins op-font-semibold op-text-16 op-text-gray-600 hover:op-text-primary dark:op-text-light-text"},e.title)),(0,p.createElement)("div",{className:"op-absolute op-bg-primary op-opacity-0 group-hover:op-opacity-100 op-bottom-0 group-hover:op-bottom-[28px] op-flex op-gap-xxsmall op-rounded-full op-py-[8px] op-px-xsmall op-duration-500 op-z-50"},"pro"===e?.type&&(0,p.createElement)(r.Z,{text:(0,c.__)("Premium","omnipress")},(0,p.createElement)("button",{type:"button"},(0,p.createElement)(g.KWE,{className:"op-text-card op-w-5 op-h-5"}))),(0,p.createElement)(f,{isFavorite:!!t?.favorites?.[e.key],demoKey:e.key}))))):(0,p.createElement)("h2",{className:"op-font-poppins op-text-18 op-font-semibold dark:op-text-light-text"},(0,c.__)("No items found","omnipress")))))))}function f({isFavorite:e,demoKey:o}){const[t,a]=(0,m.useState)(e||!1);return(0,p.createElement)(r.Z,{text:t?(0,c.__)("Remove from favorites","omnipress"):(0,c.__)("Add to favorites","omnipress"),position:"right"},(0,p.createElement)("button",{type:"button",onClick:()=>{a(!t),i()({method:t?"DELETE":"POST",path:"/omnipress/v1/demos/favorites",data:{key:o}})}},t?(0,p.createElement)(d.M_L,{className:"op-text-red-500 op-w-5 op-h-5"}):(0,p.createElement)(d.lo,{className:"op-text-card op-w-5 op-h-5"})))}},7611:(e,o,t)=>{t.d(o,{Z:()=>n});var p=t(9196),r=t(8912),a=t(9307),l=t(5736),s=t(9583);const n=function({openFilter:e,setOpenFilter:o,total:t,categories:n,onClick:i}){const[m,c]=(0,a.useState)("");return(0,p.createElement)("div",{className:`filter-sidebar-wrap op-absolute lg:op-relative op-z-10 op-bg-card ${e?" op-w-80 md:op-w-60":"op-hidden op-overflow-hidden"} op-duration-200 op-shadow-2xl md:op-shadow-none op-border-r op-border-r-border op-z-50`},(0,p.createElement)("div",{className:(e?"op-flex":"op-hidden")+" op-gap-3 op-items-center op-h-[60px] op-border-b op-border-b-border op-px-6"},(0,p.createElement)(r.Z,{text:(0,l.__)("Close filter","omnipress"),position:"top"},(0,p.createElement)("button",{onClick:()=>o(!e),className:" op-bg-primary hover:op-bg-primary/80 op-rounded-md op-w-8 op-h-8 op-flex op-items-center op-justify-center"},(0,p.createElement)(s.ulB,{className:"op-text-card "}))),(0,p.createElement)("h2",{className:`${!e&&"op-hidden"} op-font-poppins op-text-18 op-font-semibold op-text-card-foreground`},(0,l.__)("Categories","omnipress"))),(0,p.createElement)("div",{className:"op-flex op-flex-col op-gap-2 op-h-[calc(100vh-36vh)] op-relative op-overflow-hidden op-overflow-y-auto op-scrollbar-thin op-scrollbar-thumb-rounded-full op-scrollbar-track-rounded-full op-scrollbar-thumb-gray-500 op-scrollbar-track-gray-300"},(0,p.createElement)("div",{onClick:()=>{c(""),i(null)},className:"op-font-poppins op-text-14 op-cursor-pointer op-py-[10px] op-px-5 op-border-b op-border-b-border"},(0,p.createElement)("a",{className:(m?"":"op-text-primary dark:op-text-primary op-font-bold")+" op-flex op-items-center op-justify-between op-gap-2 op-text-card-foreground op-font-semibold  hover:op-text-primary focus:op-ring-0 op-group"},(0,l.__)("All","omnipress"),(0,p.createElement)("span",{className:" op-bg-muted op-cursor-pointer op-text-card-foreground op-text-[12px] op-font-semibold op-rounded-[20px] op-py-[2px] op-px-[12px] group-hover:!op-bg-primary group-hover:!op-text-card"},t))),!!n&&Object.keys(n).map((e=>(0,p.createElement)("div",{key:e,onClick:()=>{c(e),i({...n[e],key:e})},className:"op-font-poppins op-text-14 op-cursor-pointer op-py-[10px] op-px-5 op-border-b op-border-b-border"},(0,p.createElement)("a",{className:(e===m?"op-text-primary op-font-bold":"")+" op-flex op-items-center op-justify-between op-gap-2 op-text-card-foreground op-font-semibold  hover:op-text-primary focus:op-ring-0 op-group "},(0,p.createElement)("span",null,n[e].label),(0,p.createElement)("span",{className:"op-bg-muted op-cursor-pointer op-text-card-foreground op-text-[12px] op-font-semibold op-rounded-[20px] op-py-[2px] op-px-[12px] group-hover:!op-bg-primary group-hover:!op-text-card"},n[e].count)))))))}},3478:(e,o,t)=>{t.d(o,{Z:()=>l});var p=t(9196),r=t(9307);let a={};function l({gradient:e,height:o,width:t,className:l,src:s}){const n={background:e,height:null!=o?o:"100%",width:null!=t?t:"100%",filter:"blur(15px)"},[i,m]=(0,r.useState)(!!a?.[s]);return(0,r.useEffect)((()=>{a?.[s]||m(!1)}),[s]),(0,p.createElement)(p.Fragment,null,!i&&(0,p.createElement)("div",{className:"op-animate-pulse",style:n}),(0,p.createElement)("img",{style:i?{}:{position:"absolute",visibility:"hidden"},className:l,src:s,alt:s,onLoad:()=>{m(!0),a={...a,[s]:!0}},loading:"lazy"}))}},7364:(e,o,t)=>{t.d(o,{N:()=>a,O:()=>r});var p=t(9196);function r({children:e,isLoading:o,className:t,height:r,width:a}){return(0,p.createElement)(p.Fragment,null,o?(0,p.createElement)(p.Fragment,null,r||a?(0,p.createElement)("div",{className:`skeleton-wrap op-rounded-[5px] op-bg-slate-300 dark:op-bg-slate-600 op-animate-pulse ${t}`},(0,p.createElement)("div",{style:{height:r,width:a}})):(0,p.createElement)("div",{className:`skeleton-wrap op-rounded-[5px] op-bg-slate-300 dark:op-bg-slate-600 op-animate-pulse ${t}`})):(0,p.createElement)(p.Fragment,null,e))}function a({total:e,isLoading:o,children:t,height:a,width:l,className:s}){return o?[...Array(e||6).keys()].map((e=>(0,p.createElement)(r,{className:s,key:e,height:a,width:l,isLoading:!0}))):t}}}]);