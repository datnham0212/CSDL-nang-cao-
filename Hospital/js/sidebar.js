function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    var content = document.getElementById("content");
    var body = document.body;

    sidebar.classList.toggle("show");
    content.classList.toggle("hide");
    body.classList.toggle("sidebar-toggled");
}


document.addEventListener("DOMContentLoaded", function() {
    const staffToggle = document.getElementById("staff-toggle");
    const staffSubmenu = document.getElementById("staff-submenu");

    staffToggle.addEventListener("click", function() {
        staffSubmenu.classList.toggle("show");
    });
});
