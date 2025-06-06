import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

export function createNotification(title, icon, body, url) {
    const notification = new Notification(title, {
        icon: icon,
        body: body,
    });
    notification.onclick = function () {
        window.open(url);
    };
    return notification;
}

export function getCsrfToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
}

export function sendTokenToServer(token) {
    // fetch("/notification/save-token", {
    //     method: "POST",
    //     headers: {
    //         "Content-Type": "application/json",
    //         "X-CSRF-TOKEN": getCsrfToken(),
    //     },
    //     body: JSON.stringify({
    //         token: token,
    //         user_id: window.authUserID,
    //     }),
    // }).then(r => {
    //     // Optional: Handle response
    // });
}

const firebaseConfig = {
    apiKey: "AIzaSyCzwNIZpMgHYf8LQEiCf4StNnkZ-KaiPYA",
    authDomain: "ntti-api-notification.firebaseapp.com",
    projectId: "ntti-api-notification",
    storageBucket: "ntti-api-notification.appspot.com",
    messagingSenderId: "1089995641746",
    appId: "1:1089995641746:web:e56fda78745b256b8e274b",
};

const VAPID_KEY =
    "BKBAHPooKC4jqqEgKztVKJh9hAvh7FM-vfw8KlPs8E7H8QXOLCVrrFGfB_2E3zecFHgAMEjdM0Dfaq4Wh34gTwY";

export function initializeFirebaseMessaging() {
    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);

    navigator.serviceWorker
        .register("/firebase-messaging-sw.js")
        .then(function (_registration) {
            Notification.requestPermission().then((permission) => {
                if (permission === "granted") {
                    getToken(messaging, {
                        vapidKey: VAPID_KEY,
                    }).then((currentToken) => {
                        if (currentToken) {
                            sendTokenToServer(currentToken);
                        } else {
                            console.log("No registration token available.");
                        }
                    });
                }
            });
        });

    onMessage(messaging, (payload) => {
        const result = payload.notification;
        if (payload.data.user_id === window.authUserID) {
            createNotification(
                result.title,
                "asset/NTTI/notifications/icons-notification.png",
                result.body,
                result.data.url
            );
        }
    });
}

