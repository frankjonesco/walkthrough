/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  safelist: [
    "text-green-600",
    "text-red-600",
    "text-gray-600",

],
  plugins: [],
}
