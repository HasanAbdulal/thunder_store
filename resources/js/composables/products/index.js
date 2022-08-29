import axios from "axios";
import { ref } from "vue";

export default function useProduct() {
    const products = ref([]);
    const cartCount = ref(0); // Cart reactive

    // To have the product
    const getProducts = async () => {
        let response = await axios.get("/api/products");
        products.value = response.data.cartContent;

        cartCount.value = response.data.cartCount;
    };

    // Add to basket
    const add = async (productId) => {
        let response = await axios.post("/api/products", {
            productId: productId,
        });
        return response.data.cartCount;
    };

    // Count the items
    const getCount = async () => {
        let response = await axios.get("/api/products/count");
        return response.data.count;
    };

    // To increase n° of product
    const increaseQuantity = async (id) => {
        await axios.get("/api/products/increase/" + id);
    };

    // To decrease n° of product
    const decreaseQuantity = async (id) => {
        await axios.get("/api/products/decrease/" + id);
    };

    // To deleting the product
    const destroyProduct = async (id) => {
        await axios.delete("/api/products/" + id);
    };

    return {
        add,
        getCount,
        products,
        getProducts,
        increaseQuantity,
        decreaseQuantity,
        destroyProduct,
        cartCount,
    };
}
