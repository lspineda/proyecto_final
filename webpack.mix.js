let mix = require("laravel-mix");

/*
|----------------------------------------------------------------------
| Compila los archivos JavaScript individuales en la carpeta public/js.
|----------------------------------------------------------------------
*/

mix.js("resources/assets/js/vendor.js", "public/js");
mix.js("resources/assets/js/product.js", "public/js");
mix.js("resources/assets/js/stock.js", "public/js");
mix.js("resources/assets/js/category.js", "public/js");
mix.js("resources/assets/js/invoice.js", "public/js");
mix.js("resources/assets/js/report.js", "public/js");
mix.js("resources/assets/js/role.js", "public/js");
mix.js("resources/assets/js/user.js", "public/js");
mix.js("resources/assets/js/customer.js", "public/js");
mix.js("resources/assets/js/dashboard.js", "public/js");
