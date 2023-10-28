function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    sidebar.classList.toggle('show');
    content.classList.toggle('hide');
}

document.addEventListener("DOMContentLoaded", function() {
    const staffToggle = document.getElementById("staff-toggle");
    const staffSubmenu = document.getElementById("staff-submenu");

    staffToggle.addEventListener("click", function() {
        staffSubmenu.classList.toggle("show");
    });
});
