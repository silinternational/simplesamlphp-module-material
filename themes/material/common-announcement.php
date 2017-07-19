<?php
$announcementHtml = $this->configuration->getValue('announcement');

if (! empty($announcementHtml)) {
?>
  <p class="mdl-typography--subhead mdl-typography--text-center alert margin">
      <?= $announcementHtml ?>
  </p>
<?php
}
?>
