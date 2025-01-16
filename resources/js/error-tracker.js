// Global error handler with more robust error capture
window.addEventListener("error", function (event) {
    const errorDetails = {
        message: event.message,
        source: event.filename,
        lineno: event.lineno,
        colno: event.colno,
        stack: event.error ? event.error.stack : null,
        userAgent: navigator.userAgent,
        timestamp: new Date().toISOString(),
        url: window.location.href,
    };

    sendErrorToLaravel(errorDetails);
});

// Unhandled promise rejection handler
window.addEventListener("unhandledrejection", function (event) {
    const errorDetails = {
        message: event.reason.message || "Unhandled Promise Rejection",
        stack: event.reason.stack,
        type: "Promise Rejection",
        timestamp: new Date().toISOString(),
        url: window.location.href,
    };

    sendErrorToLaravel(errorDetails);
});

function sendErrorToLaravel(errorDetails) {
    // Prevent logging of trivial or expected errors
    if (shouldIgnoreError(errorDetails)) {
        return;
    }

    try {
        fetch("/log-js-error", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": getCSRFToken(),
            },
            body: JSON.stringify(errorDetails),
            credentials: "same-origin", // Important for sending cookies
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                console.log("Error successfully logged in Laravel", data);
            })
            .catch((error) => {
                // Fallback logging mechanism
                console.error("Failed to log error:", error);
                localStorage.setItem(
                    "failedErrorLog",
                    JSON.stringify(errorDetails)
                );
            });
    } catch (e) {
        console.error("Error in error logging:", e);
    }
}

// Helper function to get CSRF token
function getCSRFToken() {
    const metaToken = document.querySelector('meta[name="csrf-token"]');
    return metaToken ? metaToken.getAttribute("content") : null;
}

// Function to filter out unimportant errors
function shouldIgnoreError(errorDetails) {
    const ignoredErrors = [
        "ResizeObserver loop limit exceeded",
        "Script error.",
        // Add more patterns of errors you want to ignore
    ];

    return ignoredErrors.some((pattern) =>
        errorDetails.message.includes(pattern)
    );
}
