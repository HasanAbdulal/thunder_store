<template>
    <div class="flex items-center justify-between py-4">
        <button class="bg-blue-600 text-white p-2 rounded-lg px-6" @click.prevent="addToCart">
            Add to Cart
        </button>
    </div>
</template>

<script setup>
const addToCart = () => {
    console.log("added");
};
</script>
