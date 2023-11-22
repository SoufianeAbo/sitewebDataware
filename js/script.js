const registerBtn = document.getElementById("registerLink");
const loginBtn = document.getElementById("loginLink");

const loginForm = document.getElementById("formLogin");
const registerForm = document.getElementById("formRegister");

registerBtn.addEventListener("click", () => {
    loginForm.classList.add("hidden");
    registerForm.classList.remove("hidden");
});

loginBtn.addEventListener("click", () => {
    loginForm.classList.remove("hidden");
    registerForm.classList.add("hidden");
});
