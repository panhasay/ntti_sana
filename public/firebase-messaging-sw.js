self.addEventListener("install", (event) => {
    console.log("Service worker installing...");
    self.skipWaiting().then(r => console.log(r));
});

self.addEventListener("activate", (event) => {
    console.log("Service worker activating...");
    event.waitUntil(
        self.clients.claim()
    );
});
self.addEventListener("push", function (event) {
    let notificationData = {};

    if (event.data) {
        try {
            notificationData = event.data ? event.data.json() : {};
        } catch (error) {
            console.warn("Error parsing push data:", error);
            return;
        }
    } else {
        console.warn("Push event received without data.");
        return;
    }

    const notificationTitle =
        notificationData.notification.title || "Default Title";
    const notificationOptions = {
        body: notificationData.notification.body || "Default body message.",
        icon:
            notificationData.notification.icon ||
            "asset/NTTI/notifications/icons-notification.png",
        data: {
            url: notificationData.data.url || "https://web.ntti.thesis.edu.kh/",
        },
        actions: [
            { action: "view", title: "View" },
            { action: "close", title: "Close" },
        ],
        badge: "asset/NTTI/notifications/icons-notification.png",
        vibrate: [200, 100, 200],
        requireInteraction: false,
    };
    event.waitUntil(
        self.registration.showNotification(notificationTitle, notificationOptions)
    );
});

self.addEventListener("notificationclick", function (event) {
    event.notification.close();

    if (event.action === "close") {
        //console.log("Notification close action clicked.");
        return;
    }

    event.waitUntil(
        clients
            .matchAll({ type: "window", includeUncontrolled: true })
            .then((clientList) => {
                const matchingClient = clientList.find(
                    (client) => client.url === event.notification.data.url
                );
                if (matchingClient && "focus" in matchingClient) {
                    return matchingClient.focus();
                } else {
                    return clients.openWindow(event.notification.data.url);
                }
            })
    );
});

self.addEventListener("notificationclose", function (event) {
    //console.log("Notification closed:", event.notification);
});
