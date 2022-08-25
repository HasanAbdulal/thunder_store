import "./bootstrap";


import Toaster from "@meforma/vue-toaster";
import Alpine from "alpinejs";
import { createApp } from "vue";
import AddToCart from "./components/AddToCart.vue";
import NavbarCart from "./components/NavbarCart.vue";

window.Alpine = Alpine;

Alpine.start();

const app = createApp();
app.component("AddToCart", AddToCart);
app.component("NavbarCart", NavbarCart);
// Notivation https://github.com/MeForma/vue-toaster
app.use(Toaster).provide('toast', app.config.globalProperties.$toast);

app.mount("#app");
