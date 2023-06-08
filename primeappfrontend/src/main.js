import { createApp } from "vue";
import "./style.css";

import store from "./store";
import router from "../src/components/router";
import App from "./App.vue";
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
 

createApp(App).use(store).use(router).use(ToastPlugin).mount("#app");
