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
import { inject } from "vue";
import useProduct from "../composables/products";

const { add } = useProduct();
const productId = defineProps(["productId"]);

// Modification instance
// const emitter = require("tiny-emitter/instance");

// Notivaication
const toast = inject("toast");
//
const addToCart = async () => {
    await axios.get("/sanctum/csrf-cookie");
    //
    await axios
        .get("/api/user")
        .then(async () => {
            let cartCount = await add(productId);
            emitter.emit("refreshCartCount", cartCount);
            // Noti
            toast.success("Product added to shopping cart :)");
        })
        .catch(() => {
            toast.error("Login first to add this product");
        });
};
</script>
