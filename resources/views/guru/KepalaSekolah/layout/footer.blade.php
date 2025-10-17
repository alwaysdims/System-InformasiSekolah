
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // Sidebar Toggle
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    // Dropdown Menu Belajar
    const belajarToggle = document.getElementById('belajarToggle');
    const belajarMenu = document.getElementById('belajarMenu');
    const belajarIcon = document.getElementById('belajarIcon');

    belajarToggle.addEventListener('click', () => {
        belajarMenu.classList.toggle('hidden');
        belajarIcon.classList.toggle('rotate-180');
    });

    // Dropdown Layanan Aduan
    const aduanToggle = document.getElementById('aduanToggle');
    const aduanMenu = document.getElementById('aduanMenu');
    const aduanIcon = document.getElementById('aduanIcon');

    aduanToggle.addEventListener('click', () => {
        aduanMenu.classList.toggle('hidden');
        aduanIcon.classList.toggle('rotate-180');
    });

    window.addEventListener("click", function (e) {
        const profileButton = document.querySelector(
            "button[onclick='toggleDropdown()']"
        );
        const dropdownMenu = document.getElementById("dropdown-menu");
        const overlay = document.getElementById('overlay');

        if (
            profileButton &&
            !profileButton.contains(e.target) &&
            !dropdownMenu.contains(e.target)
        ) {
            dropdownMenu.classList.add("hidden");
        }

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
