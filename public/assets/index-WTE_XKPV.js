import{r as i,a as V,o as U,u,b as l,c,d as m,w as e,e as B,f as t,g as h,h as y,t as E,i as M,s as R,N as T}from"./index-C6obk38n.js";const F={__name:"index",setup(z){const v=M(),k=B(),x=i(!1),s=i(!0),n=i(!1);i(!1);const o=V({show:!1,type:"success",content:""}),a=V({name:"",email:""}),b=()=>{v.push({name:"profile.edit"}),s.value=!1},I=()=>{v.push({name:"profile"}),s.value=!0},N=()=>{n.value=!0,R.put("/api/profile",a).then(function(d){o.show=!0,o.content=d.data.message,u().loadProfile(),setTimeout(function(){n.value=!1,o.show=!1,o.content="",I()},1500)}).catch(function(d){n.value=!1,T.error("操作失败")})};return U(async()=>{k.name=="profile.edit"&&b(),a.name=u().userInfo.name,a.email=u().userInfo.email,await u().loadProfile(),a.name=u().userInfo.name,a.email=u().userInfo.email,x.value=!0}),(d,r)=>{const p=l("a-button"),g=l("a-space"),w=l("a-input"),f=l("a-form-item"),C=l("icon-check"),P=l("a-form"),S=l("a-card");return c(),m(S,{title:"个人资料",style:{"min-height":"500px"}},{extra:e(()=>[t(g,null,{default:e(()=>[s.value==!0?(c(),m(p,{key:0,type:"dashed","html-type":"submit",onClick:b},{default:e(()=>[h("编辑")]),_:1})):y("",!0)]),_:1})]),default:e(()=>[t(P,{model:a,style:{width:"500px"},size:"large",onSubmit:N},{default:e(()=>[t(f,{field:"name",label:"昵称",disabled:s.value||n.value},{default:e(()=>[t(w,{modelValue:a.name,"onUpdate:modelValue":r[0]||(r[0]=_=>a.name=_),placeholder:"please enter your post..."},null,8,["modelValue"])]),_:1},8,["disabled"]),t(f,{field:"email",label:"邮箱",disabled:s.value||n.value},{default:e(()=>[t(w,{modelValue:a.email,"onUpdate:modelValue":r[1]||(r[1]=_=>a.email=_),placeholder:"please enter your post..."},null,8,["modelValue"])]),_:1},8,["disabled"]),t(f,null,{default:e(()=>[t(g,null,{default:e(()=>[s.value==!1&&!o.show?(c(),m(p,{key:0,type:"primary","html-type":"submit",loading:n.value},{default:e(()=>[h("提交编辑")]),_:1},8,["loading"])):y("",!0),o.show?(c(),m(p,{key:1,type:"primary",status:"success"},{icon:e(()=>[t(C)]),default:e(()=>[h(" "+E(o.content),1)]),_:1})):y("",!0)]),_:1})]),_:1})]),_:1},8,["model"])]),_:1})}}};export{F as default};
