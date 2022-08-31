import axios from "axios";

// https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat
export const priceFormat = (price) => {
    return new Intl.NumberFormat("fr-BE", {
        style: "currency",
        currency: "EUR",
    }).format(price / 100);
};

// You save the passed order in "stripe/index.js" before redirecting to the thankYou route.
export const saveOrder = async () => {
    await axios.post("/saveOrder");
};
