<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<base href="<?= SimpleSAML\Module::getModuleURL('material/') ?>">

<?php
$trackingId = htmlentities($this->configuration->getValue('analytics.trackingId'));
$hasGATracking = false;

if (! empty($trackingId)) {
    $hasGATracking = true;
?>
    <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', '<?= $trackingId ?>', 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
<?php
}
?>


<?php
// This block of code is intended to be temporary until the transition from
// Google's Universal Analytics to GA4 type projects has been completed
$trackingIdGA4 = htmlentities($this->configuration->getValue('analytics.trackingIdGA4'));
if (! empty($trackingIdGA4)) {
    $hasGATracking = true;
?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $trackingIdGA4 ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?= $trackingIdGA4 ?>');
    </script>
<?php
}

if (! $hasGATracking) {
?>
    <script>
        window.ga = function () {
            // Null object pattern to avoid `if (window.ga)` wherever ga is used.
        }
    </script>
<?php
}
?>


<?php
$colors = htmlentities($this->configuration->getValue('theme.color-scheme') ?: 'indigo-purple');
?>
<link rel="stylesheet" href="material.<?= $colors ?>.1.2.1.min.css">
<link rel="stylesheet" href="styles.2.3.6.css">

<script async src="material.1.2.1.min.js"></script>

<link rel="icon" href="/favicon.png">
