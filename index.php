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

    <link rel="stylesheet" href="css/normalize.css?k=00100">
    <link rel="stylesheet" href="css/main.css?k=00100">
    <link rel="stylesheet" href="css/root.css?k=00100">

    <meta name="theme-color" content="#fafafa">
</head>
<body>
<main>
    <h1 class="title">
            <?php echo $fmt("header-line-1"); ?><br />
            <?php echo $fmt("header-line-2"); ?>
    </h1>
    <img src="img/quebecor-<?php echo $locale; ?>.png" alt="Québecor Média Inc." />
</main>
<!-- Google Analytics -->
<script>
  window.ga = function () { ga.q.push(arguments); };
  ga.q      = [];
  ga.l      = +new Date;
  ga('create', 'UA-XXXXX-Y', 'auto');
  ga('set', 'anonymizeIp', true);
  ga('set', 'transport', 'beacon');
  ga('send', 'pageview');
</script>
<script src="https://www.google-analytics.com/analytics.js" async></script>
</body>
</html>
