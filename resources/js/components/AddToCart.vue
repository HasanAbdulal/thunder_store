<template>
    <div class="flex items-center justify-between py-4">
        <button
            class="bg-blue-600 text-white p-2 rounded-lg px-6"
            @click.prevent="addToCart"
        >
            Add to Cart
        </button>
    </div>
</template>

<script setup>
import useProduct from "../composables/products";
const { add, cartCount } = useProduct();
const productId = defineProps(["productId"]);
// const { inject } = require("vue");
// const toast = inject("toast");
import { createToaster } from "@meforma/vue-toaster";
const toast = createToaster({});

// Modification instance
// import { Emitter } from "tiny-emitter";

// Notificaication

//
const addToCart = async () => {
    await axios.get("/sanctum/csrf-cookie");
    //
    await axios
        .get("/api/user")
        .then(async () => {
            await add(productId.productId);
            toast.success("Product added to shopping cart! ");
            // emitter.emit("refreshCartCount", cartCount);
        })
        .catch(() => {
            toast.error("Login first to add this product");
            return;
        });
};
</script>
