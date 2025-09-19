{{-- Theme Toggle Component --}}
<div class="flex items-center">
    <label for="theme-toggle" class="sr-only">Toggle dark mode</label>
    <button 
        type="button" 
        id="theme-toggle"
        class="theme-toggle"
        role="switch"
        aria-checked="false"
        aria-label="Toggle between light and dark mode"
        title="Toggle theme"
    >
        <span class="theme-toggle-handle">
            <span class="theme-toggle-icon sun">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                </svg>
            </span>
            <span class="theme-toggle-icon moon">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </span>
        </span>
    </button>
    <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
        <span id="theme-label">Light mode</span>
    </span>
</div>

<script>
// Theme toggle that delegates to the centralized ThemeManager for consistency
(function() {
    function initWithManager(manager) {
        const btn = document.getElementById('theme-toggle');
        const label = document.getElementById('theme-label');
        if (!btn || !label || !manager) return;
        
        function syncUI(theme) {
            const isDark = theme === 'dark';
            btn.classList.toggle('active', isDark);
            btn.setAttribute('aria-checked', String(isDark));
            btn.title = isDark ? 'Switch to light mode' : 'Switch to dark mode';
            label.textContent = isDark ? 'Dark mode' : 'Light mode';
        }
        
        // Initial sync with manager state
        syncUI(manager.getTheme());
        
        // Click toggles via manager (handles persistence and html attribute)
        btn.addEventListener('click', function() {
            const newTheme = manager.toggle();
            // UI will sync again on themeChanged event, but update immediately too
            syncUI(newTheme);
        });
        
        // Keep UI in sync if theme changes elsewhere (keyboard shortcut/system)
        window.addEventListener('themeChanged', function(e) {
            if (e && e.detail && e.detail.theme) {
                syncUI(e.detail.theme);
            }
        });
    }

    function fallbackInit() {
        // Fallback if ThemeManager isn't available for some reason
        const btn = document.getElementById('theme-toggle');
        const label = document.getElementById('theme-label');
        const html = document.documentElement;
        const STORAGE_KEY = 'cms-theme';
        const MANUAL_KEY = 'cms-theme-manual';
        if (!btn || !label) return;
        
        function apply(theme) {
            html.setAttribute('data-theme', theme);
            localStorage.setItem(STORAGE_KEY, theme);
            const isDark = theme === 'dark';
            btn.classList.toggle('active', isDark);
            btn.setAttribute('aria-checked', String(isDark));
            btn.title = isDark ? 'Switch to light mode' : 'Switch to dark mode';
            label.textContent = isDark ? 'Dark mode' : 'Light mode';
        }
        
        const saved = localStorage.getItem(STORAGE_KEY) || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        apply(saved);
        
        btn.addEventListener('click', function() {
            const current = html.getAttribute('data-theme') || 'light';
            const next = current === 'light' ? 'dark' : 'light';
            localStorage.setItem(MANUAL_KEY, 'true');
            apply(next);
            window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: next } }));
        });
    }

    function tryInit() {
        if (window.themeManager) {
            initWithManager(window.themeManager);
        } else {
            // Poll briefly for themeManager in case app.js attaches it slightly later
            let retries = 0;
            const timer = setInterval(() => {
                if (window.themeManager) {
                    clearInterval(timer);
                    initWithManager(window.themeManager);
                } else if (++retries > 20) { // ~2s
                    clearInterval(timer);
                    fallbackInit();
                }
            }, 100);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', tryInit);
    } else {
        tryInit();
    }
})();
</script>