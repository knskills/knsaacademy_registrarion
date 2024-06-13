import "bootstrap";

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false, // Make sure this matches your Pusher settings
    wsHost: window.location.hostname, // Make sure this matches your Pusher settings
    wsPort: 6001, // Make sure this matches your Pusher settings
    wssPort: 6001, // Make sure this matches your Pusher settings
    enabledTransports: ["ws"], // Make sure this matches your Pusher settings
    disabledStats: true,
});

// // Log a message when Echo is initialized
// console.log("Echo initialized");

// // Log the current Echo configuration
// console.log("Echo configuration:", window.Echo);

// // Check if Echo is connected to Pusher
// window.Echo.connector.pusher.connection.bind("connected", () => {
//     console.log("Connected to Pusher");
// });

// // Listen for general connection errors
// window.Echo.connector.pusher.connection.bind("error", (error) => {
//     console.error("Pusher connection error:", error);
// });

