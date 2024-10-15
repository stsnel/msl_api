/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: [
      {
        mytheme: {
    // "primary": "#009bff",
    "secondary": "#7A7974",
    // "accent": "#006fff",
    // "neutral": "#331510",
    "base-100": "#14140D",
    // "info": "#00ccff",
    // "success": "#00e5be",
    // "warning": "#f0cd00",
    // "error": "#ff6a8b",
          },
        },
      ],
    },
  plugins: [
    require('daisyui')
  ],
}


