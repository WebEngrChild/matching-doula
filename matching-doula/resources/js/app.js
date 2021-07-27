/**
     * First we will load all of this project's JavaScript dependencies which
     * includes Vue and other libraries. It is a great starting point when
     * building robust, powerful web applications using Vue and Laravel.
     */

 require("./bootstrap")

 window.Vue = require("vue")

 import BootstrapVue from "bootstrap-vue" //Importing

 Vue.use(BootstrapVue) // Teslling Vue to use this whole application

 /**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

 // const files = require.context('./', true, /\.vue$/i);
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

 Vue.component(
     "example-component",
     require("./components/ExampleComponent.vue").default
 )

 /**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const app = new Vue({
     el: "#app"
 })

import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { faAddressCard, faClock } from '@fortawesome/free-regular-svg-icons'
import { faSearch, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faCamera } from '@fortawesome/free-solid-svg-icons'

library.add(faSearch, faAddressCard, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faClock, faCamera);

dom.watch();

document.querySelector('.image-picker input')
.addEventListener('change', (e) => {
    // ここに画像が選択された時の処理を記述する
    const input = e.target;
    const reader = new FileReader();
    reader.onload = (e) => {
    // ここに、画像を読み込んだ後の処理を記述する
        input.closest('.image-picker').querySelector('img').src = e.target.result
    };
    // ここに、画像を読み込む処理を記述する
    reader.readAsDataURL(input.files[0]);
});
