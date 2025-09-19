/**
 * Theme Manager - Handles dark/light mode switching with persistence
 * Provides centralized theme management for the CMS interface
 */

class ThemeManager {
    constructor() {
        this.themes = ['light', 'dark'];
        this.currentTheme = 'light';
        this.storageKey = 'cms-theme';
        this.manualKey = 'cms-theme-manual';
        this.html = document.documentElement;
        
        this.init();
    }
    
    /**
     * Initialize the theme manager
     */
    init() {
        // Load saved theme or detect system preference
        this.loadTheme();
        
        // Listen for system theme changes
        this.setupSystemThemeListener();
        
        // Setup keyboard shortcuts
        this.setupKeyboardShortcuts();
        
        // Apply initial theme
        this.applyTheme(this.currentTheme, false);
    }
    
    /**
     * Load theme from localStorage or system preference
     */
    loadTheme() {
        const savedTheme = localStorage.getItem(this.storageKey);
        
        if (savedTheme && this.themes.includes(savedTheme)) {
            this.currentTheme = savedTheme;
        } else if (this.supportsSystemTheme()) {
            // Use system preference if no saved theme
            this.currentTheme = this.getSystemTheme();
        }
    }
    
    /**
     * Apply theme to the document
     * @param {string} theme - Theme name ('light' or 'dark')
     * @param {boolean} animate - Whether to animate the transition
     */
    applyTheme(theme, animate = true) {
        if (!this.themes.includes(theme)) {
            console.warn(`Invalid theme: ${theme}`);
            return;
        }
        
        // Add transition class for smooth animation
        if (animate) {
            this.html.classList.add('theme-transitioning');
        }
        
        // Apply theme
        this.html.setAttribute('data-theme', theme);
        // Ensure Tailwind dark: variants respond by toggling the 'dark' class
        if (theme === 'dark') {
            this.html.classList.add('dark');
        } else {
            this.html.classList.remove('dark');
        }
        this.currentTheme = theme;
        
        // Save to localStorage
        localStorage.setItem(this.storageKey, theme);
        
        // Update meta theme-color for mobile browsers
        this.updateMetaThemeColor(theme);
        
        // Dispatch theme change event
        this.dispatchThemeEvent(theme);
        
        // Remove transition class after animation
        if (animate) {
            setTimeout(() => {
                this.html.classList.remove('theme-transitioning');
            }, 200);
        }
    }
    
    /**
     * Toggle between light and dark themes
     */
    toggle() {
        const newTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.applyTheme(newTheme);
        
        // Mark as manually set
        localStorage.setItem(this.manualKey, 'true');
        
        return newTheme;
    }
    
    /**
     * Get current theme
     * @returns {string} Current theme name
     */
    getTheme() {
        return this.currentTheme;
    }
    
    /**
     * Check if current theme is dark
     * @returns {boolean} True if dark theme is active
     */
    isDark() {
        return this.currentTheme === 'dark';
    }
    
    /**
     * Set specific theme
     * @param {string} theme - Theme to set
     */
    setTheme(theme) {
        if (this.themes.includes(theme)) {
            this.applyTheme(theme);
            localStorage.setItem(this.manualKey, 'true');
        }
    }
    
    /**
     * Reset to system preference
     */
    resetToSystem() {
        localStorage.removeItem(this.manualKey);
        if (this.supportsSystemTheme()) {
            this.applyTheme(this.getSystemTheme());
        }
    }
    
    /**
     * Check if system theme detection is supported
     * @returns {boolean} True if supported
     */
    supportsSystemTheme() {
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches !== undefined;
    }
    
    /**
     * Get system theme preference
     * @returns {string} System theme ('light' or 'dark')
     */
    getSystemTheme() {
        if (this.supportsSystemTheme()) {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        return 'light';
    }
    
    /**
     * Setup system theme change listener
     */
    setupSystemThemeListener() {
        if (!this.supportsSystemTheme()) return;
        
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        
        mediaQuery.addEventListener('change', (e) => {
            // Only apply system theme if user hasn't manually set preference
            if (!localStorage.getItem(this.manualKey)) {
                this.applyTheme(e.matches ? 'dark' : 'light');
            }
        });
    }
    
    /**
     * Setup keyboard shortcuts for theme switching
     */
    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + Shift + D to toggle theme
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'D') {
                e.preventDefault();
                this.toggle();
            }
        });
    }
    
    /**
     * Update meta theme-color for mobile browsers
     * @param {string} theme - Current theme
     */
    updateMetaThemeColor(theme) {
        let metaThemeColor = document.querySelector('meta[name="theme-color"]');
        
        if (!metaThemeColor) {
            metaThemeColor = document.createElement('meta');
            metaThemeColor.name = 'theme-color';
            document.head.appendChild(metaThemeColor);
        }
        
        // Set appropriate color based on theme
        const colors = {
            light: '#ffffff',
            dark: '#111827'
        };
        
        metaThemeColor.content = colors[theme] || colors.light;
    }
    
    /**
     * Dispatch custom theme change event
     * @param {string} theme - New theme
     */
    dispatchThemeEvent(theme) {
        const event = new CustomEvent('themeChanged', {
            detail: {
                theme: theme,
                isDark: theme === 'dark',
                timestamp: Date.now()
            },
            bubbles: true
        });
        
        document.dispatchEvent(event);
    }
    
    /**
     * Get theme statistics for analytics
     * @returns {object} Theme usage statistics
     */
    getStats() {
        return {
            currentTheme: this.currentTheme,
            isManuallySet: !!localStorage.getItem(this.manualKey),
            systemTheme: this.getSystemTheme(),
            supportsSystemDetection: this.supportsSystemTheme()
        };
    }
}

// Initialize theme manager when DOM is ready
let themeManager;

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        themeManager = new ThemeManager();
        window.themeManager = themeManager; // Make globally accessible
    });
} else {
    themeManager = new ThemeManager();
    window.themeManager = themeManager;
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ThemeManager;
}