export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            boxShadow: {
                center: "0px 0px 10px rgba(0,0,0,1)",
            },
            scale: {
                102: '1.02'
            },
        },
    },
    plugins: [
        require("@designbycode/tailwindcss-text-shadow")({
            shadowColor: "rgba(0, 0, 0, 0.8)",
            shadowBlur: "3px",
            shadowOffsetX: "2px",
            shadowOffsetY: "2px",
        }),
    ],
};
