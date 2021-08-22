/**
     * First we will load all of this project's JavaScript dependencies which
     * includes Vue and other libraries. It is a great starting point when
     * building robust, powerful web applications using Vue and Laravel.
     */

//  require("./bootstrap")　ここをコメントアウト


window.Vue = require("vue")

//==========ここから追加==========
 import './bootstrap'
 import Vue from 'vue'
 import ArticleLike from './components/ArticleLike'
 //==========ここまで追加==========

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
     el: "#app",
     components: { //ここを追加
        ArticleLike, //ここを追加
      }
 })

import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { faAddressCard, faClock } from '@fortawesome/free-regular-svg-icons'
import { faSearch, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faCamera, faHeart, faGift} from '@fortawesome/free-solid-svg-icons'

library.add(faSearch, faAddressCard, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faClock, faCamera, faHeart, faGift);

dom.watch();

document.querySelectorAll('input').forEach(function (input) {
    input.addEventListener('change',  (e) => {
    // ここに画像が選択された時の処理を記述する
    const input = e.target;
    const reader = new FileReader();

    console.log(e.target.name);

    //条件分岐
    switch (e.target.name) {
        case 'first' :
            reader.onload = (e) => {
                document.getElementById('first').src = e.target.result
            }
            break;

        case 'second' :
            reader.onload = (e) => {
                document.getElementById('second').src = e.target.result
            }
            break;
        case 'third' :
            reader.onload = (e) => {
                document.getElementById('third').src = e.target.result
            }
                break;
        default:
            reader.onload = (e) => {
                input.closest('.image-picker').querySelector('img').src = e.target.result
            }

    };
    // ここに、画像を読み込む処理を記述する
    reader.readAsDataURL(input.files[0]);
})});
