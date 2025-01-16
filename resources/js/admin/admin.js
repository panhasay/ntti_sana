const $loader = $(".loader");
$("body").on("click", "#run-command-btn", function (e) {
    $loader
        .css({
            position: "fixed",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            "z-index": "1000",
        })
        .fadeIn("slow");

    const requestData = {
        command: $("#cmd_migrate").val(),
    };
    $.ajax({
        url: "/admin-panel/excute",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {
            $("#command-output").html(data);

            setTimeout(function () {
                $loader.fadeOut();
            }, 100);
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
            setTimeout(function () {
                $loader.fadeOut();
            }, 100);
        },
    });
});
$("body").on("click", "#run-npm-btn", function (e) {
    $loader
        .css({
            position: "fixed",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            "z-index": "1000",
        })
        .fadeIn("slow");

    const requestData = {
        command: $("#command-input").val(),
    };
    $.ajax({
        url: "/admin-panel/excute-npm",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {
            $("#command-output").html(data);

            setTimeout(function () {
                $loader.fadeOut();
            }, 100);
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
            setTimeout(function () {
                $loader.fadeOut();
            }, 100);
        },
    });
});
