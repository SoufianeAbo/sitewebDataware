// const mobileDash = document.getElementById("mobileDash");
// const mobileNav = document.getElementById("mobileNav");

// mobileNav.addEventListener("click", () => {
//     mobileDash.classList.remove("hidden");
//     mobileDash.classList.add("animate-slide-in-right");
//     mobileDash.classList.remove("animate-slide-out-right");
// });

// document.addEventListener("click", navbar);

// function navbar(event) {
//     if (event.target !== mobileNav && event.target !== mobileNav) {
//         mobileDash.classList.remove("animate-slide-in-right");
//         mobileDash.classList.add("animate-slide-out-right");
//     }
// }

const projectsBtn = document.getElementById("ProjectsBtn");
const projectsTable = document.getElementById("ProjectsTable");

const teamsBtn = document.getElementById("TeamsBtn");
const teamsTable = document.getElementById("TeamsTable");

projectsBtn.addEventListener("click", () => {
    projectsBtn.className = "flex items-center active-nav-link text-white py-4 pl-6 nav-item cursor-pointer";
    teamsBtn.className = "flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item cursor-pointer";
    projectsTable.classList.remove("hidden");
    teamsTable.classList.add("hidden");
});

teamsBtn.addEventListener("click", () => {
    teamsBtn.className = "flex items-center active-nav-link text-white py-4 pl-6 nav-item cursor-pointer";
    projectsBtn.className = "flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item cursor-pointer";
    projectsTable.classList.add("hidden");
    teamsTable.classList.remove("hidden");
});