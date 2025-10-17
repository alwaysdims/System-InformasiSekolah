</main>

<script>
    // Toggle Dropdown for User Profile
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdown-menu");
        dropdown.classList.toggle("hidden");
    }

    // Toggle Sidebar for Mobile
    const toggleSidebarBtn = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById('overlay');

    toggleSidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-full");
        overlay.classList.toggle("hidden");
    });

    // Close Dropdown and Sidebar when clicking outside
    window.addEventListener("click", function (e) {
        const profileButton = document.querySelector(
            "button[onclick='toggleDropdown()']"
        );
        const dropdownMenu = document.getElementById("dropdown-menu");
        const overlay = document.getElementById('overlay');

        // Close profile dropdown
        if (
            profileButton &&
            !profileButton.contains(e.target) &&
            !dropdownMenu.contains(e.target)
        ) {
            dropdownMenu.classList.add("hidden");
        }

        // Close sidebar if open and clicked outside on small screens
        // Check if sidebar is NOT hidden (-translate-x-full) and click is outside sidebar and toggle button
        if (
            window.innerWidth < 640 &&
            !sidebar.contains(e.target) &&
            !toggleSidebarBtn.contains(e.target) &&
            !sidebar.classList.contains("-translate-x-full") &&
            !overlay.classList.contains("hidden")
        ) {
            sidebar.classList.add("-translate-x-full");
            overlay.classList.add("hidden");
        }
    });
</script>
</body>

</html>