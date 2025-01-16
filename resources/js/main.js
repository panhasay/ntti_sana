import "./components/component_select2";
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

async function handleDynamicImport(checkAuthRoute) {
    try {
        switch (checkAuthRoute) {
            case "dash-stu-acc":
                // await import("./dashboard/dashboard-student");
                break;
            case "certificate.student_card":
                await import("./certificate/certificate");
                break;
            case "admin.ap":
                await import("./admin/admin");
                break;
            default:
                break;
        }
    } catch (error) {
        console.error("Dynamic Import Error:", error);
    }
}

handleDynamicImport(checkAuthRoute);
