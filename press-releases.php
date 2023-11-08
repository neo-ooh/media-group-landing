<?php
require_once "./lib/I18n.php";

function inferLocale(): string {
    function is_locale_valid($str): bool {
        return in_array($str, ["en", "fr"]);
    }

    // Override from URL
    $locale = isset($_GET["lang"]) ? $_GET["lang"] : null;

    if(!is_locale_valid($locale)) {
        // As previously set
        $locale = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : null;

        if(!is_locale_valid($locale)) {
            // Use browser provided locale
            $locale = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

            if(!is_locale_valid($locale)) {
                // Fallback to english
                $locale = 'en';
            }
        }
    }

    // Store lang for latter access to the page
    setcookie("lang", $locale, ["expires" => 3600 * 24 * 365]);

    return $locale;
}

$locale = inferLocale();
$fmt = new I18n($locale);

?>
<!doctype html>
<html class="no-js" lang="en">
<!-- * 2021 Copyright Neo-OOH Tous droits réservés.
     *
     * Written by Valentin Dufois <vdufois@neo-ooh.com> -->
<head>
    <meta charset="utf-8">
    <title><?php echo $fmt("title"); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!--    <link rel="manifest" href="site.webmanifest">-->
    <!--    <link rel="apple-touch-icon" href="icon.png">-->
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/root.css">

    <meta name="theme-color" content="#fafafa">
</head>
<body>

<!-- Add your site or application content here -->
<header>
    <div class="header-caption">
        <?php echo $fmt("press-releases.desc"); ?>
    </div>
    <a href="press-releases.php?lang=<?php echo $locale === "en" ? "fr" : "en"; ?>"
       class="language-switcher">
        <?php echo $locale === "en" ? "FR" : "EN"; ?>
    </a>
</header>

<script src="js/vendor/modernizr-3.11.2.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
</html>
