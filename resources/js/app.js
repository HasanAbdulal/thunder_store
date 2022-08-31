import "./bootstrap";

import Alpine from "alpinejs";
import { createApp } from "vue";
import AddToCart from "./components/AddToCart.vue";
import NavbarCart from "./components/NavbarCart.vue";
import ShoppingCart from "./components/ShoppingCart.vue";
import StripeCheckout from "./components/StripeCheckout.vue";
import Toaster from "@meforma/vue-toaster";

window.Alpine = Alpine;

Alpine.start();

const app = createApp();

// Notification https://github.com/MeForma/vue-toaster
app.use(Toaster).provide("toast", app.config.globalProperties.$toast);

app.component("AddToCart", AddToCart)
    .component("NavbarCart", NavbarCart)
    .component("ShoppingCart", ShoppingCart)
    .component("StripeCheckout", StripeCheckout)

app.mount("#app");
