export function initSelect2(selector) {
    $(selector)
        .select2()
        .on("select2:open", function () {
            let searchField = document.querySelector(".select2-search__field");
            if (searchField) {
                searchField.focus();
            }
        });
}

export function select2AdvancedModal(att_id, att_modal) {
    if (typeof $ !== "undefined" && $.fn.select2) {
        $(att_id)
            .select2({
                dropdownParent: $(att_modal),
                width: "100%",
            })
            .on("select2:open", function () {
                let searchField = document.querySelector(
                    ".select2-search__field"
                );
                if (searchField) {
                    searchField.focus();
                }
            });
    } else {
        console.error("jQuery or Select2 is not loaded");
    }
}

export function eventFilter(att_btn) {
    const buttons = document.querySelectorAll(att_btn);

    if (buttons.length > 0) {
        buttons.forEach((button) => {
            button.addEventListener("click", function () {
                const icon = this.querySelector("i");
                if (icon) {
                    icon.classList.toggle("mdi-arrow-down-bold");
                    icon.classList.toggle("mdi-arrow-up-bold");
                }
            });
        });
    } else {
        //console.error("Error: No buttons found with the specified selector!");
    }
}

export function sendAjaxRequest(url, method, data, onSuccess, onError) {
    const $loader = $('<div id="loader"></div>')
        .css({
            position: "fixed",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            "z-index": "1000",
            width: "50px",
            height: "50px",
            "background-color": "#ccc",
            "border-radius": "50%",
            animation: "spin 1s linear infinite",
        })
        .appendTo("body")
        .fadeIn("fast");

    $.ajax({
        url: url,
        method: method,
        data: data ?? {},
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (response) {
            $loader.fadeOut("fast", function () {
                $(this).remove();
            });
            if (typeof onSuccess === "function") {
                onSuccess(response);
            }
        },
        error: function (xhr, status, error) {
            $loader.fadeOut("fast", function () {
                $(this).remove();
            });
            console.error("AJAX Error:", status, error);

            if (typeof onError === "function") {
                onError(xhr, status, error);
            }
        },
    });
}
