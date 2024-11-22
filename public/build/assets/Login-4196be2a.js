import{T as w,e as d,b as o,u as s,w as m,F as b,o as n,Z as h,t as x,f as u,a as t,c as k,g as c,j as y,n as V,i as v}from"./app-3f293c5c.js";import{A as $}from"./AuthenticationCard-cbf61d88.js";import{_ as B}from"./AuthenticationCardLogo-830d15a2.js";import{_ as C}from"./Checkbox-15ab5f03.js";import{_ as f,a as p}from"./TextInput-643496f1.js";import{_}from"./InputLabel-2ea817cc.js";import{_ as F}from"./PrimaryButton-1eb25ee9.js";import"./_plugin-vue_export-helper-c27b6911.js";const N={key:0,class:"mb-4 font-medium text-sm text-green-600"},S=["onSubmit"],q={class:"mt-4"},L={class:"block mt-4"},P={class:"flex items-center"},R=t("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),U={class:"flex items-center justify-end mt-4"},G={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){const e=w({email:"",password:"",remember:!1}),g=()=>{e.transform(i=>({...i,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(i,a)=>(n(),d(b,null,[o(s(h),{title:"Log in"}),o($,null,{logo:m(()=>[o(B)]),default:m(()=>[l.status?(n(),d("div",N,x(l.status),1)):u("",!0),t("form",{onSubmit:v(g,["prevent"])},[t("div",null,[o(_,{for:"email",value:"Email"}),o(f,{id:"email",modelValue:s(e).email,"onUpdate:modelValue":a[0]||(a[0]=r=>s(e).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),o(p,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",q,[o(_,{for:"password",value:"Password"}),o(f,{id:"password",modelValue:s(e).password,"onUpdate:modelValue":a[1]||(a[1]=r=>s(e).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),o(p,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),t("div",L,[t("label",P,[o(C,{checked:s(e).remember,"onUpdate:checked":a[2]||(a[2]=r=>s(e).remember=r),name:"remember"},null,8,["checked"]),R])]),t("div",U,[l.canResetPassword?(n(),k(s(y),{key:0,href:i.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>[c(" Forgot your password? ")]),_:1},8,["href"])):u("",!0),o(F,{class:V(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:m(()=>[c(" Log in ")]),_:1},8,["class","disabled"])])],40,S)]),_:1})],64))}};export{G as default};
