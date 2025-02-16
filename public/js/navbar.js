document.addEventListener('DOMContentLoaded', () => {
    const navBtn = document.getElementById('btn-menu');
    const navMenu = document.getElementById('navMenu');
    const userBtn = document.getElementById('user-menu');
    const userMenu = document.getElementById('user-dropdown');

    if (navBtn && navMenu) {
        navBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            navMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !navBtn.classList.contains('hidden')) {
                navMenu.classList.add('hidden');
            }
        })
    }
    userBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target) && !userBtn.classList.contains('hidden')) {
            userMenu.classList.add('hidden');
        }
    })
    // }

})