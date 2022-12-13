import{l as h,h as y,m as w,b as s,o as n,g as _,p as x,u as v,c as u,w as m,a as t,H as V,t as $,k as c,d as r,L as B,e as f,n as C,f as L}from"./app.6a0b19b0.js";import{_ as N}from"./GuestLayout.3a443db8.js";import{_ as p,a as g,b as k}from"./TextInput.1459f691.js";import{_ as R}from"./PrimaryButton.c4e9b198.js";import"./_plugin-vue_export-helper.cdc0426e.js";const S=["value"],U={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null}},emits:["update:checked"],setup(l,{emit:e}){const i=l,d=h({get(){return i.checked},set(a){e("update:checked",a)}});return(a,o)=>y((n(),_("input",{type:"checkbox",value:l.value,"onUpdate:modelValue":o[0]||(o[0]=b=>x(d)?d.value=b:null),class:"rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"},null,8,S)),[[w,s(d)]])}},q={key:0,class:"mb-4 font-medium text-sm text-green-600"},F=["onSubmit"],P={class:"mt-4"},D={class:"block mt-4"},E={class:"flex items-center"},H=r("span",{class:"ml-2 text-sm text-gray-600 dark:text-gray-400"},"Remember me",-1),M={class:"flex items-center justify-end mt-4"},I={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){const e=v({email:"",password:"",remember:!1}),i=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})};return(d,a)=>(n(),u(N,null,{default:m(()=>[t(s(V),{title:"Log in"}),l.status?(n(),_("div",q,$(l.status),1)):c("",!0),r("form",{onSubmit:L(i,["prevent"])},[r("div",null,[t(p,{for:"email",value:"Email"}),t(g,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[0]||(a[0]=o=>s(e).email=o),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(k,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),r("div",P,[t(p,{for:"password",value:"Password"}),t(g,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[1]||(a[1]=o=>s(e).password=o),required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(k,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),r("div",D,[r("label",E,[t(U,{name:"remember",checked:s(e).remember,"onUpdate:checked":a[2]||(a[2]=o=>s(e).remember=o)},null,8,["checked"]),H])]),r("div",M,[l.canResetPassword?(n(),u(s(B),{key:0,href:d.route("password.request"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:m(()=>[f(" Forgot your password? ")]),_:1},8,["href"])):c("",!0),t(R,{class:C(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:m(()=>[f(" Log in ")]),_:1},8,["class","disabled"])])],40,F)]),_:1}))}};export{I as default};
