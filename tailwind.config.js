/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "resources/views/**/*.blade.php",
        "resources/views/**/*.vue",
        "resources/js/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Merriweather", "sans-serif"],
                title: ["Rubik Mono One", "sans-serif"],
            },
            spacing: {
                150: "150px",
            },
        },
    },
    plugins: [require("@tailwindcss/typography")],
};
