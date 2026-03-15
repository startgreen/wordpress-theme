/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './blocks/**/*.php',
    './src/**/*.js',
    // Explicitly exclude node_modules in case the glob above is too broad.
    '!./node_modules/**',
  ],
  theme: {
    extend: {
      colors: {
        green: {
          primary: '#1a7a4a',
          light:   '#2ecc71',
          dark:    '#145c37',
          // Keep Tailwind's default green shades so btn-primary (@apply green-600)
          // continues to work.  The values below mirror Tailwind's defaults.
          50:  '#f0fdf4',
          100: '#dcfce7',
          200: '#bbf7d0',
          300: '#86efac',
          400: '#4ade80',
          500: '#22c55e',
          600: '#16a34a',
          700: '#15803d',
          800: '#166534',
          900: '#14532d',
          950: '#052e16',
        },
      },
      fontFamily: {
        sans: [ 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif' ],
      },
      maxWidth: {
        '8xl': '88rem',
      },
      aspectRatio: {
        '4/3': '4 / 3',
        '16/9': '16 / 9',
      },
      backgroundImage: {
        'gradient-green': 'linear-gradient(135deg, #1a7a4a 0%, #145c37 100%)',
      },
      keyframes: {
        'fade-in': {
          '0%':   { opacity: '0', transform: 'translateY(10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
      animation: {
        'fade-in': 'fade-in 0.4s ease-out both',
      },
    },
  },
  plugins: [],
};
