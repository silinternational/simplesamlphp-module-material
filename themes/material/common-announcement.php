<?php
$announcement = $this->data['announcement'];

if (! empty($announcement)) {
?>
  <p class="mdl-typography--subhead mdl-typography--text-center alert">
      <?= $announcement ?>
  </p>
<?php
}
?>
