import Alpine from "alpinejs";
import "./main";
import "./error-tracker";

import { initializeFirebaseMessaging } from "./config-notification";

initializeFirebaseMessaging();

window.Alpine = Alpine;
Alpine.start();
