/** @type {import('tailwindcss').Config} */
export default {
  important: true,
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
          "primary": "#e19728",
          "secondary": "#28e1e1",
          "accent": "#facc87",
          "neutral": "#f4f2ed",
          "base-100": "#c7c5c0",
          "info": "#2847e1",
          "success": "#28e1a3",
          "warning": "#e1e128",
          "error": "#e15628",
          },
        },
      ],
    },
  plugins: [
    require('daisyui')
  ],
}


