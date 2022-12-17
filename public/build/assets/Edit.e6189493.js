import{u as y,o as n,g as d,a as e,b as l,w as u,F as p,H as x,d as a,f as b,h as w,M as V,G as S,e as _,q as h,t as k}from"./app.b030cbe5.js";import{_ as U}from"./AuthenticatedLayout.d21c0701.js";import{_ as m,a as c,b as i}from"./TextInput.6eb76e91.js";import{_ as $}from"./PrimaryButton.01c3882b.js";import{_ as q}from"./LinkComponent.a6dee35e.js";import{S as B}from"./sweetalert2.all.164b698d.js";const F={class:"bg-white shadow sm:rounded-lg mb-5 p-4 sm:p-8"},N=a("div",{class:"md:grid md:grid-cols-2"},[a("header",null,[a("h2",{class:"text-lg font-medium text-gray-900 dark:text-gray-100"},"User Information"),a("p",{class:"mt-1 text-sm text-gray-600 dark:text-gray-400"}," Update user's profile information and email address. ")])],-1),R={class:"md:grid md:grid-cols-3"},E=a("option",{value:""},"Select Role",-1),M=["value"],z={class:"flex flex-col md:flex-row gap-4"},G={__name:"Edit",props:{module:{type:String,required:!0},moduleRoute:{type:String,required:!0},model:Object,roles:Array},setup(g){const r=g,f="/"+r.moduleRoute,s=y({first_name:r.model.first_name,last_name:r.model.last_name,email:r.model.email,role:r.model.roles[0].name});function v(){s.patch(route(r.moduleRoute+".update",r.model.id),{preserveScroll:!0,onSuccess:()=>{B.fire({title:"Success",text:"Updated successfully.",icon:"success",confirmButtonColor:"#16a34a"}).then(()=>{h.Inertia.get(f)})}})}return(C,o)=>(n(),d(p,null,[e(l(x),{title:r.module},null,8,["title"]),e(U,null,{default:u(()=>[a("div",F,[N,a("div",R,[a("form",{onSubmit:o[4]||(o[4]=b(t=>v(),["prevent"])),class:"mt-6 space-y-6 md:col-span-1"},[a("div",null,[e(m,{for:"first_name",value:"First Name"}),e(c,{id:"first_name",type:"text",class:"mt-1 block w-full",modelValue:l(s).first_name,"onUpdate:modelValue":o[0]||(o[0]=t=>l(s).first_name=t),required:"",autofocus:"",autocomplete:"first_name"},null,8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.first_name},null,8,["message"])]),a("div",null,[e(m,{for:"last_name",value:"Last Name"}),e(c,{id:"last_name",type:"text",class:"mt-1 block w-full",modelValue:l(s).last_name,"onUpdate:modelValue":o[1]||(o[1]=t=>l(s).last_name=t),required:"",autocomplete:"last_name"},null,8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.last_name},null,8,["message"])]),a("div",null,[e(m,{for:"email",value:"Email"}),e(c,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:l(s).email,"onUpdate:modelValue":o[2]||(o[2]=t=>l(s).email=t),required:"",autocomplete:"email"},null,8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.email},null,8,["message"])]),a("div",null,[e(m,{for:"role",value:"Role"}),w(a("select",{"onUpdate:modelValue":o[3]||(o[3]=t=>l(s).role=t),id:"country",name:"country",autocomplete:"country-name",class:"mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm h-10 capitalize"},[E,(n(!0),d(p,null,S(r.roles,t=>(n(),d("option",{key:t.id,value:t.name,class:"capitalize"},k(t.name),9,M))),128))],512),[[V,l(s).role]]),e(i,{class:"mt-2",message:l(s).errors.role},null,8,["message"])]),a("div",z,[e(q,{href:f,type:"secondary"},{default:u(()=>[_(" Back ")]),_:1}),e($,{disabled:l(s).processing},{default:u(()=>[_(" Save ")]),_:1},8,["disabled"])])],32)])])]),_:1})],64))}};export{G as default};