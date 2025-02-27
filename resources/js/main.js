import "./config-csrf-token";
import "./bootstrap";

import {
    eventFilter,
    initSelect2,
    select2AdvancedModal,
} from "./utils/helpers";

eventFilter("#btn_filter");
initSelect2(".select2-search");
select2AdvancedModal(".select2-sch-modal", ".modal-select2");

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        "X-Requested-With": "XMLHttpRequest",
    },
});
async function handleDynamicImport(checkAuthRoute) {
    const importMap = {
        "certificate.student_card": () => import("./certificate/certificate"),
        "admin.ap": () => import("./admin/admin"),
    };

    try {
        if (importMap[checkAuthRoute]) {
            await importMap[checkAuthRoute]();
        } else {
            //console.warn(`No matching module for route: ${checkAuthRoute}`);
        }
    } catch (error) {
        console.error(
            `Dynamic Import Error for route "${checkAuthRoute}":`,
            error
        );
    }
}

handleDynamicImport(checkAuthRoute);
