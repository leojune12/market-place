import{_ as i}from"./AuthenticatedLayout.4c3982be.js";import{o as c,g as r,a,b as n,w as d,F as x,H as _,d as s,t as e,e as o}from"./app.de9bbd46.js";import{_ as l}from"./LinkComponent.80b5cbf5.js";const g={class:"overflow-hidden bg-white shadow sm:rounded-lg mb-5"},p=s("div",{class:"px-4 py-5 sm:px-6"},[s("h3",{class:"text-lg font-medium leading-6 text-gray-900"},"User Information"),s("p",{class:"mt-1 max-w-2xl text-sm text-gray-500"},"Personal details and application.")],-1),h={class:"border-t border-gray-200"},y={class:"bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"},f=s("dt",{class:"text-sm font-medium text-gray-500"},"First name",-1),u={class:"mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"},b={class:"bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"},v=s("dt",{class:"text-sm font-medium text-gray-500"},"Last name",-1),w={class:"mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"},B={class:"bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"},k=s("dt",{class:"text-sm font-medium text-gray-500"},"Email address",-1),E={class:"mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"},F={class:"bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"},N=s("dt",{class:"text-sm font-medium text-gray-500"},"Role",-1),V={class:"mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize"},A={class:"bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"},C=s("dt",{class:"text-sm font-medium text-gray-500"},"Created At",-1),H={class:"mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"},S={class:"flex flex-col md:flex-row gap-4 py-6 sm:px-6 px-4"},I={__name:"Show",props:{model:Object,roles:Array},setup(t){const m="/users";return(U,$)=>(c(),r(x,null,[a(n(_),{title:"User"}),a(i,null,{default:d(()=>[s("div",g,[p,s("div",h,[s("dl",null,[s("div",y,[f,s("dd",u,e(t.model.first_name),1)]),s("div",b,[v,s("dd",w,e(t.model.last_name),1)]),s("div",B,[k,s("dd",E,e(t.model.email),1)]),s("div",F,[N,s("dd",V,e(t.model.roles[0].name),1)]),s("div",A,[C,s("dd",H,e(t.model.date_added),1)])])]),s("div",S,[a(l,{href:m,type:"secondary"},{default:d(()=>[o(" Back ")]),_:1}),a(l,{href:m+"/"+t.model.id+"/edit",type:"primary"},{default:d(()=>[o(" Edit ")]),_:1},8,["href"])])])]),_:1})],64))}};export{I as default};
