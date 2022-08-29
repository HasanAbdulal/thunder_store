import { ref } from "vue";
import axios from "axios";
import { saveOrder } from "../../helpers";

export default function useStripe() {
    const elements = ref(null);
    const stripe = ref(null);
    const clientSecret = ref(null);
    const paymentElement = ref(null);

    // https://stripe.com/docs/testing
    // Initialize a payment intent and captures the client secret
    const initialize = async () => {
        // import.meta.env.VITE_STRIPE_TEST_PUBLIC_KEY
        stripe.value = Stripe(import.meta.env.VITE_STRIPE_TEST_PUBLIC_KEY);

        const secret = await axios
            .post("/paymentIntent", {
                headers: { "Content-Type": "application/json" },
            })
            .then((re) => re.data.clientSecret)
            .catch((err) => console.log(err));
        clientSecret.value = secret;
    };

    const loadStripeElements = async () => {
        elements.value = stripe.value.elements({
            clientSecret: clientSecret.value,
        });

        paymentElement.value = elements.value.create("payment");
        paymentElement.value.mount("#payment-element");
    };

    //
    const handleSubmit = async () => {
        setLoading(true);

        const { error } = await stripe.value.confirmPayment({
            elements: elements.value,
            confirmParams: {
                // return_url: import.meta.env.VITE_APP_URL + '/checkout',
                return_url: import.meta.env.VITE_APP_URL + "/checkout",
            },
        });

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }

        setLoading(false);
    };

    // Fetches the payment intent status after payment submission
    const checkStatus = async () => {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
        );

        if (!clientSecret) {
            return;
        }

        const { paymentIntent } = await stripe.value.retrievePaymentIntent(
            clientSecret
        );

        switch (paymentIntent.status) {
            case "succeeded":
                showMessage("Payment succeeded!");
                //
                await saveOrder();
                window.location = "/thankYou";
                break;
            case "processing":
                showMessage("Your payment is processing.");
                break;
            case "requires_payment_method":
                showMessage(
                    "Your payment was not successful, please try again."
                );
                break;
            default:
                showMessage("Something went wrong.");
                break;
        }
    };

    // ------- UI helpers -------

    const showMessage = (messageText) => {
        const messageContainer = document.querySelector("#payment-message");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 4000);
    };

    // Show a spinner on payment submission
    const setLoading = (isLoading) => {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    };

    return {
        initialize,
        checkStatus,
        handleSubmit,
        clientSecret,
        loadStripeElements,
    };
}
