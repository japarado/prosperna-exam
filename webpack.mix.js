const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
	.js("resources/js/app.js", "public/js")
	.js("resources/js/pages/tests/index.js", "public/js/pages/tests/")
	.js("resources/js/pages/auth/register.js", "public/js/pages/auth/")
	.js("resources/js/pages/auth/pay.js", "public/js/pages/auth/")
	.postCss("resources/css/app.css", "public/css", [
		require("postcss-import"),
		require("tailwindcss"),
		require("autoprefixer"),
	])
	.sourceMaps(true, "source-map")
	.browserSync({
		proxy: "https://prosperna-exam.apc",
		open: false
	});
