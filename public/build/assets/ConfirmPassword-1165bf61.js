import{T as m,d,e as c,b as o,u as e,w as r,F as u,o as p,Z as f,a,n as _,g as w,i as b}from"./app-3f293c5c.js";import{A as g}from"./AuthenticationCard-cbf61d88.js";import{_ as h}from"./AuthenticationCardLogo-830d15a2.js";import{_ as x,a as v}from"./TextInput-643496f1.js";import{_ as y}from"./InputLabel-2ea817cc.js";import{_ as V}from"./PrimaryButton-1eb25ee9.js";import"./_plugin-vue_export-helper-c27b6911.js";const C=a("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),$=["onSubmit"],k={class:"flex justify-end mt-4"},q={__name:"ConfirmPassword",setup(A){const s=m({password:""}),t=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(B,i)=>(p(),c(u,null,[o(e(f),{title:"Secure Area"}),o(g,null,{logo:r(()=>[o(h)]),default:r(()=>[C,a("form",{onSubmit:b(n,["prevent"])},[a("div",null,[o(y,{for:"password",value:"Password"}),o(x,{id:"password",ref_key:"passwordInput",ref:t,modelValue:e(s).password,"onUpdate:modelValue":i[0]||(i[0]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),o(v,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),a("div",k,[o(V,{class:_(["ml-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],40,$)]),_:1})],64))}};export{q as default};
