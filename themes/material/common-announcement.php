<?php
$announcementHtml = $this->configuration->getValue('announcement');

if (! empty($announcementHtml)) {
?>
  <div class="mdl-typography--subhead mdl-typography--text-center alert margin">
      <?= $announcementHtml ?>
  </div>
<?php
}
?>
