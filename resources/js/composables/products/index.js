export default function useProduct() {
    // Add to basket
    const add = async (productId) => {
        let response = await axios.post("/api/products", {
            productId: productId,
        });
        return response.data.cart;
    };

    // Count the items
    const getCount = async () => {
        let response = await axios.get("/api/products/count");
        return response.data.count;
    };

    return {
        add,
        getCount,
    };
}
