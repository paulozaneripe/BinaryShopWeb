const currentPage = location.pathname
const menuItems = document.querySelectorAll(".menu .links a")

for (item of menuItems) {
    if (currentPage.includes(item.getAttribute("href"))) {
        item.classList.add("selected")
    }
}