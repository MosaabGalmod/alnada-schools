/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/**/*.php',
    ],
    safelist: [
        // Dynamic grid cols used in _stats.blade.php
        'lg:grid-cols-3',
        'lg:grid-cols-4',
        'lg:grid-cols-5',
        'grid-cols-2',
        'grid-cols-3',
        // Footer 12-col span grid
        'sm:grid-cols-2',
        'lg:col-span-2',
        'lg:col-span-3',
        'lg:col-span-4',
    ],
    theme: {
        extend: {
            fontFamily: {
                heading: ['Tajawal', 'sans-serif'],
                body: ['Cairo', 'sans-serif'],
            },
            colors: {
                primary: {
                    /*
                     * Brand palette built from logo colour #59c2d5 (sky-teal)
                     * primary-500 = exact logo colour
                     */
                    50: '#f0fbfd',
                    100: '#d9f5fa',
                    200: '#b3ecf5',
                    300: '#7ddced',
                    400: '#59c2d5',
                    /* ← logo colour (was 300) */
                    500: '#59c2d5',
                    /* logo colour as semantic "brand" */
                    600: '#2da0ba',
                    /* darker for buttons — meets WCAG on white */
                    700: '#1d7f96',
                    800: '#1a6178',
                    900: '#1b5062',
                    950: '#0d2f3d',
                },
                gold: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    /* warm amber — complements logo teal */
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
            },
            borderRadius: {
                '4xl': '2rem',
                '5xl': '2.5rem',
            },
            boxShadow: {
                'clay': '0 8px 32px rgba(89,194,213,0.22), 0 2px 8px rgba(89,194,213,0.14), inset 0 1px 0 rgba(255,255,255,0.9)',
                'clay-lg': '0 20px 60px rgba(89,194,213,0.28), 0 8px 24px rgba(89,194,213,0.18), inset 0 1px 0 rgba(255,255,255,0.95)',
                'clay-gold': '0 8px 32px rgba(217,119,6,0.15), 0 2px 8px rgba(217,119,6,0.10), inset 0 1px 0 rgba(255,255,255,0.85)',
                'card': '0 4px 24px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04)',
                'card-hover': '0 16px 48px rgba(0,0,0,0.10), 0 4px 16px rgba(0,0,0,0.06)',
            },
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'blob': 'blob 8s infinite',
                'fade-up': 'fadeUp 0.7s ease-out forwards',
                'slide-in': 'slideIn 0.5s ease-out forwards',
            },
            keyframes: {
                float: {
                    '0%,100%': {
                        transform: 'translateY(0)'
                    },
                    '50%': {
                        transform: 'translateY(-10px)'
                    }
                },
                blob: {
                    '0%,100%': {
                        transform: 'translate(0,0) scale(1)'
                    },
                    '33%': {
                        transform: 'translate(20px,-20px) scale(1.08)'
                    },
                    '66%': {
                        transform: 'translate(-10px,10px) scale(0.95)'
                    }
                },
                fadeUp: {
                    from: {
                        opacity: 0,
                        transform: 'translateY(20px)'
                    },
                    to: {
                        opacity: 1,
                        transform: 'translateY(0)'
                    }
                },
                slideIn: {
                    from: {
                        opacity: 0,
                        transform: 'translateX(20px)'
                    },
                    to: {
                        opacity: 1,
                        transform: 'translateX(0)'
                    }
                },
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
