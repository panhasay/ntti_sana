const csrfToken = $('meta[name="csrf-token"]').attr("content");

window.csrfToken = csrfToken;
