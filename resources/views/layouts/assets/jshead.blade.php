{{-- JQuery --}}
<script src="{{ asset('assets/vendor/jquery/jquery-3.7.0.min.js') }}"></script>

{{-- Script Dark Mode --}}
<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
