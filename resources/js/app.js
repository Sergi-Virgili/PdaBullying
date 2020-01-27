/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Vue from "vue";
import { LMap, LTileLayer, LMarker } from "vue2-leaflet";
import { Icon } from "leaflet";
import "leaflet/dist/leaflet.css";
import Vuetify from "../plugins/vuetify";
import VueRouter from "vue-router";
import { routes } from "./routes";
import Vuex from "vuex";
// import MainApp from "./components/MainApp"
import StoreData from "./store";
import appContainer from "./components/appContainer";

// this part resolve an issue where the markers would not appear
delete Icon.Default.prototype._getIconUrl;

Icon.Default.mergeOptions({
    iconRetinaUrl: require("leaflet/dist/images/marker-icon-2x.png"),
    iconUrl: require("leaflet/dist/images/marker-icon.png"),
    shadowUrl: require("leaflet/dist/images/marker-shadow.png")
});

//window.Vue = require("vue");
Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: "history"
});



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     "app-container",
//     require("./components/appContainer.vue").default
// );
Vue.component(
    "MapComponent",
    require("./components/map-component.vue").default
);
Vue.component("MainApp", require("./components/MainApp.vue").default);

Vue.component(
    "map-component",
    require("./components/map-component.vue").default
);
Vue.component(
    "refuge-component",
    require("./components/refuge-component.vue").default
);
Vue.component(
    "refugeList-component",
    require("./components/refugeList-component.vue").default
);
Vue.component(
    "refugeNew-component",
    require("./components/refugeNew-component.vue").default
);
Vue.component(
    "publish-component",
    require("./components/publish-component.vue").default
);
Vue.component(
    "publicMap-component",
    require("./components/publicMap-component.vue").default
);
Vue.component(
    "iframe-component",
    require("./components/iframe-component.vue").default
);

Vue.component(
    "mapOptions-component",
    require("./components/mapOptions-component.vue").default
);

Vue.component(
    "createtype-component",
    require("./components/createtype-component.vue").default
);

Vue.component(
    "type-component",
    require("./components/type-component.vue").default
);

Vue.component(
    "crudtype-component",
    require("./components/crudtype-component.vue").default
);

Vue.component(
    "mapSearch-component",
    require("./components/mapSearch-component.vue").default
);
Vue.component(
    "app-container-publish",
    require("./components/appContainerPublish.vue").default
);
Vue.component(
    "toolsbar-component",
    require("./components/toolsbar-component.vue").default
);
Vue.component(
    "refugeModal-component",
    require("./components/refugeModal-component.vue").default
);
Vue.component(
    "newRefugeModal-component",
    require("./components/newRefugeModal-component.vue").default
);
Vue.component(
    "typeBox-component",
    require("./components/typeBox-component.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    store,
    vuetify: Vuetify,
    el: "#app",
    components: {
        appContainer
    }
});
