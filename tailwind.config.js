module.exports = {
  content: ["./**/*.php"],
  theme: {
    extend: {
      fontFamily: {
        sans:  ['var(--font-sans)'],
        serif: ['var(--font-serif)'],
      },
      colors: {
        'sg-light-green':  'var(--sg-light-green)',
        'sg-dark-green':   'var(--sg-dark-green)',
        'sg-brand-green':  'var(--sg-brand-green)',
        'sg-medium-green': 'var(--sg-medium-green)',
        'sg-light-grey':   'var(--sg-light-grey)',
      },
    },
  },
  plugins: [],
};
