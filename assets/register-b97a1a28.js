import"./modulepreload-polyfill-ec808ebb.js";import{m as e,B as r,F as m}from"./form-1b39d3c2.js";const n=document.querySelector(".form"),c=["name","email","password","confirm"],i=e.object({name:e.string().min(2,"name length has to between 2 and 255").max(255,"name length has to between 2 and 255"),password:e.string().min(5,"password length has to between 5 and 255").max(255,"password length has to between 5 and 255"),email:e.string().email(),confirm:e.string().min(5,"at least 5 characters").max(255,"max 255 characters")}).superRefine(({confirm:a,password:t},s)=>{a!==t&&s.addIssue({code:"custom",message:"The passwords did not match",path:["confirm"]})});n.addEventListener("submit",async a=>{a.preventDefault();const t=new m(n,c,i);try{t.validate();const o=await(await fetch(r+"/register",{body:new FormData(n),method:"POST"})).json();console.log(o)}catch{}});
