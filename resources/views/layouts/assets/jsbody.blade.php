<script>
    const themeSwitcher = document.getElementById('theme-switcher')
    const themeIconLight = document.getElementById('theme-icon-light')
    const themeIconDark = document.getElementById('theme-icon-dark')

    if (themeSwitcher) {
        themeSwitcher.addEventListener('click', () => {
            if (localStorage.theme === 'dark') {
                localStorage.theme = 'light'
                document.documentElement.classList.remove('dark')
            } else {
                localStorage.theme = 'dark'
                document.documentElement.classList.add('dark')
            }
        })

        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeSwitcher.checked = false
        } else {
            themeSwitcher.checked = true
        }
    }


</script>

