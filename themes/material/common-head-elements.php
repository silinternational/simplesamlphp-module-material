<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<base href="<?= SimpleSAML\Module::getModuleURL('material/') ?>">

<?php
$trackingId = htmlentities($this->configuration->getValue('analytics.trackingId'));
if (! empty($trackingId)) {
?>
    <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', '<?= $trackingId ?>', 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
<?php
} else {
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
