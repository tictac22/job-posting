import"./modulepreload-polyfill-ec808ebb.js";const e=document.querySelector(".form__button");document.querySelector(".input__descrp").onkeyup=function(){document.querySelector(".form__input--hint").innerHTML=255-this.value.length+" characters left",console.log(this.value.length),this.value.length===255?(e.classList.add("disabled"),e.disabled=!0):(e.classList.remove("disabled"),e.disabled=!1)};
