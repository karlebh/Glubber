import { createApp } from "vue";
import { createPinia } from "pinia";
import VueGoogleMaps from "@fawmi/vue-google-maps";
import { equal } from "fast-deep-equal";

import App from "./App.vue";
import router from "./router.js";
const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);
app.use(VueGoogleMaps, {
    load: {
        // key: import.meta.env.GOOGLE_MAP_API,
        key: "AIzaSyBUu3nagMTS1mLSGPaHz_Y1xK26uA-UHbA",
        libraries: "places",
    },
});
app.mount("#app");
