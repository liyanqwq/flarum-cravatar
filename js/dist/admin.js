module.exports=function(t){var a={};function r(e){if(a[e])return a[e].exports;var n=a[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,r),n.l=!0,n.exports}return r.m=t,r.c=a,r.d=function(t,a,e){r.o(t,a)||Object.defineProperty(t,a,{enumerable:!0,get:e})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,a){if(1&a&&(t=r(t)),8&a)return t;if(4&a&&"object"==typeof t&&t&&t.__esModule)return t;var e=Object.create(null);if(r.r(e),Object.defineProperty(e,"default",{enumerable:!0,value:t}),2&a&&"string"!=typeof t)for(var n in t)r.d(e,n,function(a){return t[a]}.bind(null,n));return e},r.n=function(t){var a=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(a,"a",a),a},r.o=function(t,a){return Object.prototype.hasOwnProperty.call(t,a)},r.p="",r(r.s=5)}({0:function(t,a){t.exports=flarum.core.compat["admin/app"]},5:function(t,a,r){"use strict";r.r(a);var e,n,i=r(0),s=r.n(i);s.a.initializers.add("ianm/gravatar",(function(){s.a.extensionData.for("ianm-gravatar").registerSetting((function(){return[m("div",{class:"helpText"},s.a.translator.trans("ianm-gravatar.admin.settings.proxy.helptext"))]})).registerSetting({label:s.a.translator.trans("ianm-gravatar.admin.settings.proxy.title"),setting:"ianm-gravatar.proxy",type:"bool"}).registerSetting((function(){return[m("div",{class:"helpText"},s.a.translator.trans("ianm-gravatar.admin.settings.replace-flarum-custom.helptext"))]})).registerSetting({label:s.a.translator.trans("ianm-gravatar.admin.settings.replace-flarum-custom.title"),setting:"ianm-gravatar.replace-flarum-custom",type:"bool"}).registerSetting((function(){return[m("h3",null,s.a.translator.trans("ianm-gravatar.admin.settings.defaults.title")),m("div",{class:"helpText"},s.a.translator.trans("ianm-gravatar.admin.settings.defaults.helptext"))]})).registerSetting({setting:"ianm-gravatar.default",type:"select",options:e||(e=["mp","identicon","monsterid","wavatar","retro","robohash"].reduce((function(t,a){return t[a]=app.translator.trans("ianm-gravatar.admin.settings.defaults."+a+"_label"),t}),{}))}).registerSetting((function(){return[m("div",{class:"helpText"},s.a.translator.trans("ianm-gravatar.admin.settings.force-default.helptext"))]})).registerSetting({label:s.a.translator.trans("ianm-gravatar.admin.settings.force-default.title"),setting:"ianm-gravatar.force-default",type:"bool"}).registerSetting((function(){return[m("h3",null,s.a.translator.trans("ianm-gravatar.admin.settings.rating.title")),m("div",{class:"helpText"},s.a.translator.trans("ianm-gravatar.admin.settings.rating.helptext"))]})).registerSetting({setting:"ianm-gravatar.rating",type:"select",options:n||(n=["g","pg","r","x"].reduce((function(t,a){return t[a]=app.translator.trans("ianm-gravatar.admin.settings.rating."+a+"_label"),t}),{}))})}))}});
//# sourceMappingURL=admin.js.map