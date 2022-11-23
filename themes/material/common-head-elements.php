<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<base href="<?= SimpleSAML\Module::getModuleURL('material/') ?>">

<?php
$trackingId = htmlentities($this->configuration->getValue('analytics.trackingId'));
if (! empty($trackingId)) {
?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $trackingId ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?= $trackingId ?>');
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
