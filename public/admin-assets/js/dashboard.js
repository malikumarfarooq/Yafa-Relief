document.addEventListener("DOMContentLoaded", function () {
    // Select all nav items that have children
    const navItems = document.querySelectorAll(".sidebar-nav-item");

    navItems.forEach(item => {
        const activeChild = item.querySelector(".sidebar-nav-item-childs .sidebar-nav-item-child.active");
        if (activeChild) {
            // Add a class to the parent if any child is active
            item.classList.add("open");
        }
    });
});

// Toggle sidebar

function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("collapsed");
}

