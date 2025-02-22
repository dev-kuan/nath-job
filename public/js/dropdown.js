document.addEventListener('DOMContentLoaded', () => {
    // Tampilkan/hidden dropdown saat button diklik
    document.querySelectorAll('.dropdown-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();

            // ambil id dropdown target
            const targetId = button.getAttribute('data-dropdown-target');
            const dropdown = document.getElementById(targetId);

            // Tampilkan/sembunyikan dropdown
            document.querySelectorAll('.dropdown').forEach(d => {
                if (d.id !== targetId) {
                    d.classList.add('hidden');
                }
            })

            dropdown.classList.toggle('hidden');
        });
    });

    // Tutup dropdown saat klik di luar area dropdown
    document.addEventListener('click', (e) => {
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
});
