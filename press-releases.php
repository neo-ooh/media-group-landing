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
<!-- * 2023 Copyright Neo-OOH Tous droits réservés.
     *
     * Written by Sébastien Meslage <smeslage@neo-ooh.com> -->
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

<main class="press-releases-main">
    <div class="brand-wrapper neo">
        <a href="<?php echo $fmt("neo.url"); ?>" target="_blank" rel="noreferrer" class="brand-logo-link">
            <div class="brand-logo <?php echo $locale ?>"></div>
        </a>
        <ul class="brand-pr-list">
            <li class="brand-pr-item">
                <a href="<?php echo $locale === "en" ? "../pdf/Press_release_Sophie_Remillard EN.pdf" : "../pdf/Communique_Sophie_Remillard_FR.pdf"; ?>" download>
                    <?php echo $locale === "en" ? "(Oct. 2023) SOPHIE RÉMILLARD JOINS NEO..." : "(Oct. 2023) SOPHIE RÉMILLARD SE JOINT À NEO..."; ?>
                </a>
            </li>
            <li class="brand-pr-item">
                <a href="<?php echo $locale === "en" ? "../pdf/Palais_des_congres_de_Mtl_EN.pdf" : "../pdf/Palais_des_congres_de_Mtl_FR.pdf"; ?>" download>
                    <?php echo $locale === "en" ? "(Oct. 2023) NEO signs with the Palais des congrès de Montréal..." : "(Oct. 2023) NEO signe avec le Palais des congrès de Montréal..."; ?>
                </a>
            </li>
            <li class="brand-pr-item">
                <a href="<?php echo $locale === "en" ? "../pdf/The Core EN.pdf" : "../pdf/The Core FR.pdf"; ?>" download>
                    <?php echo $locale === "en" ? "(Mar. 2023) NEO signs a partnership agreement with the Core Centre..." : "(Mar. 2023) NEO signe un contrat d’affichage média avec le centre Core..."; ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="brand-wrapper pompe">
        <a href="<?php echo $fmt("pompe.url"); ?>" target="_blank" rel="noreferrer" class="brand-logo-link">
            <div class="brand-logo <?php echo $locale ?>"></div>
        </a>
        <ul class="brand-pr-list">
            <li class="brand-pr-item">
                <a href="<?php echo $locale === "en" ? "../pdf/Adapt Media English.pdf" : "../pdf/Adapt Media French.pdf"; ?>" download>
                    <?php echo $locale === "en" ? "(Mar. 2023) Adapt Media and NEO combine forces in an Exclusive Sales Partnership..." : "(Mar. 2023) NEO et Adapt Média unissent leurs forces avec un partenariat exclusif de ventes...."; ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="brand-wrapper speed">
        <a href="<?php echo $fmt("speed.url"); ?>" target="_blank" rel="noreferrer" class="brand-logo-link">
            <div class="brand-logo <?php echo $locale ?>"></div>
        </a>
    </div>
    <div class="brand-wrapper staff">
        <a href="<?php echo $fmt("staff.url"); ?>" target="_blank" rel="noreferrer" class="brand-logo-link">
            <div class="brand-logo <?php echo $locale ?>"></div>
        </a>
    </div>
    <div class="brand-wrapper moblek">
        <a href="<?php echo $fmt("moblek.url"); ?>" target="_blank" rel="noreferrer" class="brand-logo-link">
            <div class="brand-logo <?php echo $locale ?>"></div>
        </a>
    </div>
</main>

<script src="js/vendor/modernizr-3.11.2.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
</html>
