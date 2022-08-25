// https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat
export const priceFormat = (price) => {
    return new Intl.NumberFormat("fr-BE", {
        style: "currency",
        currency: "EUR",
    }).format(price / 100);
};
