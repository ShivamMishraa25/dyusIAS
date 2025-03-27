document.addEventListener("DOMContentLoaded", () => {
    const callIcon = document.querySelector(".call-icon");
    const floatingCall = document.querySelector(".floating-call");

    callIcon.addEventListener("click", () => {
        floatingCall.classList.toggle("active");
    });
});
