"use strict";(globalThis.webpackChunkomnipress=globalThis.webpackChunkomnipress||[]).push([[35],{2600:(e,l,t)=>{t.r(l),t.d(l,{default:()=>L});var a=t(9196),n=t(5609),o=t(9307),s=t(5736),i=t(3854),r=t(3750),p=t(1649),u=t(3095),c=t(9700);const m=a.forwardRef((({className:e,type:l,...t},n)=>(0,a.createElement)("input",{type:l,className:(0,c.cn)("op-flex op-h-10 op-w-full op-rounded-md op-border  op-bg-background op-px-3 op-py-2 op-text-sm op-ring-offset-background file:op-border-0 file:op-bg-transparent file:op-text-sm file:op-font-medium placeholder:op-text-muted-foreground  disabled:op-cursor-not-allowed disabled:op-opacity-50",e),ref:n,...t})));m.displayName="Input";var d=t(8084),b=t(4184),_=t.n(b),f=t(2819),y=t(7106);function v({children:e}){return(0,a.createElement)("div",{className:""},e)}v.Controls=function({enableMultipleRules:e,onAddRuleSet:l,help:t,children:n,label:o="Show the block if at least one rule set applies."}){return(0,a.createElement)("div",{className:"op-conditional__panel-item op-grid op-gap-3"},(0,a.createElement)("div",null,(0,a.createElement)("div",{className:"op-flex op-font-semibold op-my-2"},(0,s.__)(o,"omnipress"),e&&(0,a.createElement)(i.p3M,{className:"op-text-[17px] op-ml-auto op-mr-[9px]",onClick:l})),t&&(0,a.createElement)("p",{className:"op-text-gray-800 op-my-4"},(0,s.__)(t,"omnipress"))),n)},v.RuleSets=function({onToggleRuleSet:e,onDuplicateRuleSet:l,onRemoveRuleSet:t,onEditRuleSetName:i,ruleSetName:r,ruleSetCount:c,children:b,enabled:v=!0}){const[g,h]=(0,o.useState)(!1),E=(0,f.uniqueId)(),S=(0,o.useRef)(null);return(0,a.createElement)("div",{"aria-disabled":!v,ref:S,className:_()("op-conditional__rule-sets-fields op-grid op-gap-4",{"op-opacity-60":!v})},(0,a.createElement)("div",{className:"op-flex op-justify-between op-items-center"},(0,a.createElement)("div",null,g?(0,a.createElement)(n.Popover,{onClose:()=>h(!g),placement:"left"},(0,a.createElement)("div",{className:"op-p-6"},(0,a.createElement)(d._,{htmlFor:E},(0,s.__)("Update Ruleset name","omnipress")),(0,a.createElement)(m,{value:r,name:E,id:E,onChange:i}))):null!=r?r:"Rule set",(0,a.createElement)("span",{className:"op-edit__ruleset-label op-ml-1",onClick:()=>{h(!g)}},(0,a.createElement)(y.Lik,null))),(0,a.createElement)(n.DropdownMenu,{icon:(0,a.createElement)(p.KZr,null),label:"tools",popoverProps:{placement:"left"}},(({onClose:o})=>(0,a.createElement)(a.Fragment,null,(0,a.createElement)(n.MenuGroup,null,(0,a.createElement)(n.MenuItem,{icon:"arrowUp",onClick:()=>{e(),o()}},v?"Disable":"Enable"),(0,a.createElement)(n.MenuItem,{icon:"arrowDown",onClick:()=>{l(),o()}},(0,s.__)("Duplicate"))),(0,a.createElement)(n.MenuGroup,null,(0,a.createElement)(n.MenuItem,{icon:"trash",onClick:()=>{t((0,u.Y)(S.current)),o()}},(0,s.__)(c>1?"Remove rule set":"Clear rule set","omnipress"))))))),(0,a.createElement)("div",{className:_()({"op-cursor-none op-pointer-events-none op-opacity-60":!v})},b))};const g=v;var h=t(7196),E=t(1511),S=t(3157);const R=function({className:e,placeholder:l,field:t,options:n,onChange:o,isMulti:s=!1}){return(0,a.createElement)(S.ZP,{className:`op-custom-select ${e}`,value:n&&t?s?n.filter((e=>t.includes(e.value))):n.find((e=>e.value===t)):s?[]:"",onChange:o,placeholder:l,options:n,isMulti:s})};var N=t(4136);function D({className:e,onChange:l,loadOptions:t,field:n,type:s="",isMulti:i=!1}){const[r,p]=(0,o.useState)(null),u=(0,o.useCallback)((0,f.debounce)((async(e,l,a)=>{if("pages"===e||!e)return void(a&&a([]));const o=await t(e,l);if(a&&a(o),!r){const e=o.filter((e=>i?n.includes(e.value):e.value===n));p(i?e:e[0])}}),300),[n]);return(0,a.createElement)(N.Z,{className:`op-custom-select-async ${e}`,value:r,cacheOptions:!0,onChange:e=>[p(e),l(e)],defaultOptions:!0,loadOptions:(e,l)=>u(s,e,l,i),isMulti:i})}var k=t(6989),w=t.n(k);const C=function({attributes:e,setAttributes:l}){const{conditionalDisplay:t}=e,n=t.location,{onSelectField:o,onDuplicateRuleSet:i,onToggleRuleSet:r,onEditRuleSetName:p,onAddRuleSet:u,onRemoveRule:c,fetchOptions:m,onRemoveRuleSet:d}=function(e,l){var t;const{conditionalDisplay:a}=e,n=null!==(t=a.location)&&void 0!==t?t:[];return{onSelectField:(e,t,o,s,i)=>{const r=n.ruleSets.map(((l,a)=>{if(a===o){const a=l.rules.map(((a,n)=>n===s?{...a,[e]:i?t.map((e=>e.value)):t.value}:l));return{...l,rules:a}}return l}));l({conditionalDisplay:{...a,location:{...n,ruleSets:r}}})},onDuplicateRuleSet:e=>{l({conditionalDisplay:{...a,location:{...n,ruleSets:[...n.ruleSets,{...e,id:(0,f.uniqueId)()}]}}})},onToggleRuleSet:t=>{l({conditionalDisplay:{...e.conditionalDisplay,location:{...n,ruleSets:n.ruleSets.map((e=>e.id===t?{...e,enable:!e.enable}:e))}}})},onEditRuleSetName:(e,t)=>{l({conditionalDisplay:{...a,location:{...n,ruleSets:n.ruleSets.map((l=>l.id===t?{...l,label:e.target.value}:l))}}})},onAddRuleSet:()=>{l({conditionalDisplay:{...a,location:{...n,ruleSets:[...n.ruleSets,{id:(0,f.uniqueId)(),enabled:!0,rules:[{type:"page_type",operator:"any",field:"page"}]}]}}})},onRemoveRule:(e,t)=>{const o=e.rules.filter((e=>e.type!==t)),s={...e,rules:o},i={...n,ruleSets:[...n.ruleSets.filter((e=>e.id!==s.id)),s]};l({conditionalDisplay:{...a,location:i}})},onRemoveRuleSet:(e,t)=>{l({conditionalDisplay:{...a,location:{...n,ruleSets:e>1?n.ruleSets.filter((e=>e.id!==t.id)):[{enable:!0,id:1,rules:[{type:"",operator:"",field:""}]}]}}})},fetchOptions:async(e,l)=>{const t="posts"===e?Array.isArray(l)?`?per_page=12&include=${l.join(",")}`:`?search=${l}`:"",a="post_types"===e?"omnipress/v1/post-type":`wp/v2/${e}${t}`,n=await w()({path:a});return"post_types"!==e?Object.values(n).map((l=>({value:"posts"===e?l.id:l.slug,label:"posts"===e?l.title.rendered:l.name}))):n}}}(e,l);if(n.ruleSets.length)return(0,a.createElement)(g.Controls,{help:(0,s.__)("Show block any of the conditions matched","omnipress"),enableMultipleRules:!0,onAddRuleSet:u,label:"Location"},e.conditionalDisplay.location?.ruleSets.map(((l,t)=>{const u=e.conditionalDisplay.location?.ruleSets.length;return(0,a.createElement)(g.RuleSets,{onDuplicateRuleSet:()=>i(l),ruleSetCount:u,enabled:l.enable,ruleSetName:n?.ruleSets?.name,key:l.id,onRemoveRuleSet:()=>{d(u,l)},onToggleRuleSet:()=>{r(l.id)},onEditRuleSetName:e=>{p(e,l.id)}},l.rules&&l.rules.map(((e,n)=>{const{type:i,operator:r,field:p}=e;return(0,a.createElement)("div",{key:i,className:"op-grid op-gap-3"},(0,a.createElement)("div",{className:"op-flex op-items-center op-justify-between"},(0,a.createElement)("p",{className:"op-mb-0"},(0,s.__)(0===t?"Show the block if":"And if")),l.rules.length>1&&(0,a.createElement)(E.Der,{onClick:()=>{c(l,i)}})),(0,a.createElement)(R,{defaultValue:"",options:h.A2,onChange:e=>o("type",e,t,n),field:i}),i&&(0,a.createElement)(R,{placeholder:"Select Condition",options:[{label:"Is any of the selected",value:"any"},{label:"Is none of the selected",value:"none"}],field:r}),"page"===i&&(0,a.createElement)(R,{placeholder:"Select Type",onChange:e=>{o("field",e,t,n,!0)},options:h.sL,isMulti:!0,field:p}),"page"!==i&&(0,a.createElement)(D,{placeholder:"Select Type",loadOptions:m,isMulti:!0,type:i,field:p,onChange:e=>{o("field",e,t,n,!0)}}))})))})))};var I=t(155);const x=a.forwardRef((({className:e,...l},t)=>(0,a.createElement)("textarea",{className:(0,c.cn)("op-flex op-min-h-[80px] op-w-full op-rounded-md op-border op-border-input op-bg-background op-px-3 op-py-2 op-text-sm op-ring-offset-background placeholder:op-text-muted-foreground focus-visible:op-outline-none focus-visible:op-ring-2 focus-visible:op-ring-ring focus-visible:op-ring-offset-2 disabled:op-cursor-not-allowed disabled:op-opacity-50",e),ref:t,...l})));x.displayName="Textarea";const A=[{label:" (All)",field:"all",help:"Show the block if at least one of the provided URL query strings is present."},{label:" (Any)",field:"any",help:"Show the block if any of the provided URL query strings is present."},{label:" (None)",field:"none",help:"Show the block if none of the provided URL query strings is present."}],U=function({attributes:e,setAttributes:l}){const t=t=>{l({conditionalDisplay:{...e.conditionalDisplay,query_string:{...e.conditionalDisplay.query_string,[t.target.name]:t.target.value}}})};return(0,a.createElement)("div",null,(0,a.createElement)("h4",{className:"op-font-semibold op-mb-2"},(0,s.__)("QUERY STRING","omnipress"),(0,a.createElement)(n.Dropdown,{className:"my-container-class-name",contentClassName:"my-dropdown-content-classname",popoverProps:{placement:"bottom-start"},renderToggle:({isOpen:e,onToggle:l})=>(0,a.createElement)(I.ib5,{className:"op-ml-2",onClick:l}),renderContent:()=>(0,a.createElement)("p",{className:"op-w-48"},(0,s.__)("The Query String control allows you to configure block visibility based on URL query strings.","omnipress"))})),(0,a.createElement)("p",{className:"op-my-2"},(0,s.__)("Enter each URL query string on a separate line.","omnipress")),A.map((l=>{var n;return(0,a.createElement)("div",{key:l.field,className:"op-grid  op-w-full op-gap-1.5"},(0,a.createElement)(d._,{className:"op-mb-2",htmlFor:"message-2"},(0,s.__)(`Required Queries ${l.label}`,"omnipress")),(0,a.createElement)(x,{name:l.field,id:l.field,value:null!==(n=e.conditionalDisplay.query_string?.[l.field])&&void 0!==n?n:"",onChange:t}),(0,a.createElement)("p",{className:"op-text-sm op-text-muted-foreground"},l.help))})))},T=[{label:"Public",type:"status",value:"public"},{label:"User is logged in",type:"status",value:"logged_in"},{label:"User is logged out",type:"status",value:"logged_out"},{label:"User Role",type:"role",value:"role"}],M=function({attributes:e,setAttributes:l}){return(0,a.createElement)("div",{label:"User Rules"},(0,a.createElement)("h4",{className:"op-font-semibold op-mb-2"},(0,s.__)("User Roles","omnipress"),(0,a.createElement)(n.Dropdown,{className:"my-container-class-name",contentClassName:"my-dropdown-content-classname",popoverProps:{placement:"bottom-start"},renderToggle:({isOpen:e,onToggle:l})=>(0,a.createElement)(I.ib5,{onClick:l,className:"op-ml-2"}),renderContent:()=>(0,a.createElement)("p",{className:"op-w-48"},(0,s.__)("The User rules control allows you to configure block visibility based on user state, roles.","omnipress"))})),(0,a.createElement)(R,{options:T,isMulti:!1,field:e.conditionalDisplay.user_rules?.type,onChange:t=>{l({conditionalDisplay:{...e.conditionalDisplay,user_rules:{...e.conditionalDisplay.user_rules,type:t.type,value:t.value}}})}}),"role"===e.conditionalDisplay.user_rules?.type&&(0,a.createElement)(R,{options:h.pR,isMulti:!0,field:e.conditionalDisplay.user_rules?.value,onChange:t=>{l({conditionalDisplay:{...e.conditionalDisplay,user_rules:{...e.conditionalDisplay.user_rules,value:t.map((e=>e.value))}}})}}),"role"!==e.conditionalDisplay.user_rules?.type&&(0,a.createElement)("p",{className:"op-text-sm op-text-muted-foreground op-mt-2"},(0,s.__)("public"===!e.conditionalDisplay.user_rules?.value?"Block is only visible to everyone":`Block is only visible to ${e.conditionalDisplay.user_rules.value} users`,"omnipress")))};function L({attributes:e,setAttributes:l}){const{conditionalDisplay:t}=e,n={location:C,user_rules:M,query_string:U};return(0,a.createElement)(g,null,(0,a.createElement)(O,{key:"conditional-toggler",attributes:e,setAttributes:l}),Object.keys(t).length>0&&Object.keys(t).map((o=>{if(!t[o])return;const s=n[o];return(0,a.createElement)(s,{key:o,attributes:e,setAttributes:l})})))}function O({attributes:e,setAttributes:l}){const{conditionalDisplay:t}=e,u={location:{ruleSets:[{enable:!0,id:1,rules:[{type:"",operator:"",field:""}]}]},user_rules:{type:"status",value:"public"},query_string:{none:"",any:"",all:""}},[c,m]=(0,o.useState)(!1);return(0,a.createElement)("div",null,(0,a.createElement)("div",{className:"op-flex"},(0,a.createElement)("span",null,(0,s.__)("Conditional Display","omnipress")),!Object.values(t).length>0?(0,a.createElement)(i.p3M,{className:(c?"is-pressed":"")+" op-text-[17px] op-ml-auto op-mr-[9px] op-cursor-pointer",onClick:()=>m(!c)}):(0,a.createElement)(r.FQA,{className:(c?"is-pressed":"")+" op-text-[17px] op-ml-auto op-mr-[9px] op-cursor-pointer",onClick:()=>m(!c)})),c&&(0,a.createElement)(n.Popover,{placement:"left",onClose:()=>m(!1)},(0,a.createElement)("div",{className:"op-p-6"},h.VC.map((o=>(0,a.createElement)(n.MenuItem,{className:"op-max-[220px] op-min-[220px] op-cursor-pointer",key:o.name,icon:e.conditionalDisplay[o.name]&&(0,a.createElement)(p.jsx,null),onClick:()=>{(e=>{if(!t[e])return void l({conditionalDisplay:{...t,[e]:{...u[e]}}});const{[e]:a,...n}=t;l({conditionalDisplay:{...n}})})(o.name)}},(0,s.__)(o.label,"omnipress")))))))}},7196:(e,l,t)=>{t.d(l,{A2:()=>r,VC:()=>n,pR:()=>s,s0:()=>o,sL:()=>i});var a=t(5736);const n=[{label:"User Roles",name:"user_rules"},{label:"Location Rules",name:"location"},{label:"Query String",name:"query_string"}],o=[{label:(0,a.__)("None","omnipress"),value:"none"},{label:(0,a.__)("Slide in down","omnipress"),value:"animate__slideInDown"},{label:(0,a.__)("Slide In Left","omnipress"),value:"animate__slideInLeft"},{label:(0,a.__)("Slide In Right","omnipress"),value:"animate__slideInRight"},{label:(0,a.__)("Slide In Up","omnipress"),value:"animate__slideInUp"},{label:(0,a.__)("Rotate Out Down Right","omnipress"),value:"animate__rotateOutDownRight"},{label:(0,a.__)("Rotate Out Down Left","omnipress"),value:"animate__rotateOutDownLeft"},{label:(0,a.__)("Flip In Y","omnipress"),value:"animate__flipInY"},{label:(0,a.__)("Flip In X","omnipress"),value:"animate__flipInX"},{label:(0,a.__)("Fade In Left","omnipress"),value:"animate__fadeInLeft"},{label:(0,a.__)("Fade In Right","omnipress"),value:"animate__fadeInRight"},{label:(0,a.__)("Fade In Up","omnipress"),value:"animate__fadeInUp"},{label:(0,a.__)("Fade In Down","omnipress"),value:"animate__fadeInDown"},{label:(0,a.__)("Back In Up","omnipress"),value:"animate__backInUp"},{label:(0,a.__)("Back In Down","omnipress"),value:"animate__backInDown"},{label:(0,a.__)("Back In Left","omnipress"),value:"animate__backInLeft"},{label:(0,a.__)("Back In Right","omnipress"),value:"animate__backInRight"}],s=[{label:"Administrator",value:"administrator"},{label:"Editor",value:"editor"},{label:"Author",value:"author"},{label:"Contributor",value:"contributor"}],i=[{label:"Front Page",value:"front_page"},{label:"Single Page",value:"single"},{label:"Archives",value:"archive"},{label:"Search Results Page",value:"search"},{label:"Posts Page",value:"posts_page"},{label:"Pages",value:"pages"},{label:"Categories",value:"categories"},{label:"Tags",value:"tags"},{label:"404",value:"404"}],r=[{label:"Page Type",value:"page"},{label:"Post Type",value:"post_types"},{label:"Taxonomy",value:"taxonomies"},{label:"Posts",value:"posts"},{label:"Post Id",value:"post_id"}]},3095:(e,l,t)=>{t.d(l,{V:()=>a,Y:()=>n});const a=(e="")=>{const l=e.match(/animate__([a-zA-Z]+)/),t=e.match(/animate__delay-([\d.]+s)/),a=e.match(/animate__repeat-(\d+)/),n=e.match(/animate__duration-([a-zA-Z]+)/);return{animationName:l?l[0]:"unknown",delay:t?t[0]:"0s",iteration:a?a[0]:"",duration:n?n[0]:"animate__animated"}},n=e=>!(!e.nextElementSibling&&!e.previousElementSibling)},8084:(e,l,t)=>{t.d(l,{_:()=>r});var a=t(9196),n=t(9102),o=t(9257),s=t(9700);const i=(0,o.j)("op-text-sm op-font-medium op-leading-none peer-disabled:op-cursor-not-allowed peer-disabled:op-opacity-70"),r=a.forwardRef((({className:e,...l},t)=>(0,a.createElement)(n.f,{ref:t,className:(0,s.cn)(i(),e),...l})));r.displayName=n.f.displayName},9700:(e,l,t)=>{t.d(l,{cn:()=>o});var a=t(512),n=t(8388);function o(...e){return(0,n.m6)((0,a.W)(e))}}}]);