<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:mfa:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script src="bowser.1.9.4.min.js"></script>
    <script>
        function disableUnsupportedFeatures() {
            if (bowser.msie) {
                disablePrint();
                disableDownload();
            } else if (bowser.msedge) {
                disableDownload();
            }
        }

        function disablePrint() {
            document.querySelector('button#print').disabled = true;
            document.querySelector('button#print').classList.add('not-allowed');
            document.querySelector('button#print').title = <?= json_encode($this->t('{material:mfa:unsupported}')) ?>;
        }

        function disableDownload() {
            document.querySelector('a[download]').href = '';
            document.querySelector('a[download]').classList.add('mdl-button--disabled', 'not-allowed');
            document.querySelector('a[download]').title = <?= json_encode($this->t('{material:mfa:unsupported}')) ?>;
        }
    </script>
</head>
<body class="gradient-bg" onload="disableUnsupportedFeatures()">
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:mfa:header}') ?>
            </span>
        </div>
    </header>
    <main class="mdl-layout__content" layout-children="column">
        <form layout-children="column" method="post">
            <?php $newCodes = $this->data['newBackupCodes']; ?>
            <?php if (! empty($newCodes)): ?>
            <h1 class="mdl-typography--display-1">
                <?= $this->t('{material:mfa:new_codes_header}') ?>
            </h1>

            <p class="mdl-typography--body-1">
                <em><?= $this->t('{material:mfa:old_codes_gone}') ?></em>
            </p>

            <p class="mdl-typography--body-1">
                <?= $this->t('{material:mfa:new_codes_info}') ?>
                <span class="mdl-typography--body-2"><?= $this->t('{material:mfa:new_codes_only_once}') ?></span>
            </p>

            <div class="mdl-card mdl-shadow--8dp" style="min-height: 17em">
                <div class="mdl-card__supporting-text ff-temp-flexbug-fix" layout-children="column" id="code-card">
                    <?php 
                    $idpName = htmlentities($this->configuration->getValue('idp_display_name', $this->configuration->getValue('idp_name', '—')));
                    ?>
                    <p class="fill-parent" layout-children="row">
                        <span flex><?= $this->t('{material:mfa:account}', ['{idpName}' => $idpName]) ?></span>
                        <em class="mdl-typography--caption"><?= date('M j, Y') ?></em>
                    </p>

                    <div class="code-container">
                        <?php foreach ($newCodes as $newCode): ?>
                        <code>☐ <?= htmlentities($newCode) ?></code>
                        <?php endforeach; ?>
                    </div>
                    
                    <span class="mdl-typography--caption"><?= $this->t('{material:mfa:new_codes_only_once}') ?></span>
                </div>
                
                <div class="mdl-card__actions" layout-children="row" child-spacing="space-around">
                    <script>
                        function printElement(selector) {
                            var elementToPrint = document.querySelector(selector);
                            
                            elementToPrint.classList.add('printable-codes');

                            window.print();
                        }
                    </script>
                    <button class="mdl-button mdl-button--primary" type="button" onclick="printElement('#code-card')" id="print">
                        <?= $this->t('{material:mfa:button_print}') ?>
                    </button>

                    <a href="data:text/plain,<?= $idpName . urlencode("\r\n" . join("\r\n", $newCodes)) ?>" 
                       download="<?= $idpName ?>-printable-codes.txt" class="mdl-button mdl-button--primary">
                        <?= $this->t('{material:mfa:button_download}') ?>
                    </a>

                    <script>
                        function copyCodesToClipboard(button) {
                            document.querySelector('textarea').select();

                            document.execCommand('copy');

                            button.innerHTML = button.innerHTML.replace('<?= $this->t("{material:mfa:button_copy}") ?>', '<?= $this->t("{material:mfa:button_copied}") ?>');
                        }
                    </script>
                    <button class="mdl-button mdl-button--primary" type="button" onclick="copyCodesToClipboard(this)">
                        <?= $this->t('{material:mfa:button_copy}') ?>
                        <textarea class="out-of-sight"><?= $idpName."\n".join("\n", $newCodes) ?></textarea>
                    </button>
                </div>
            </div>
            <?php else: ?>
            <div class="mdl-card mdl-shadow--8dp">
                <div class="mdl-card__media white-bg margin" layout-children="column">
                    <i class="mdl-color-text--red error material-icons mdl-typography--display-4">error</i>
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:error:header}') ?>
                    </h1>
                </div>

                <div class="mdl-card__supporting-text" >
                    <p>
                        <?= $this->t('{material:mfa:new_codes_failed}') ?>
                        <a href="<?= $this->data['mfaSetupUrl'] ?>" target="_blank"><?= $this->data['mfaSetupUrl'] ?></a>
                    </p>
                </div>
            </div>

            <script>
                ga('send','event','error','backupcode','generation-failed');
            </script>
            <?php endif; ?>

            <div layout-children="row" class="fill-parent">
                <label class="mdl-checkbox mdl-js-checkbox" flex>
                    <input type="checkbox" onclick="toggleContinue(this)" class="mdl-checkbox__input">
                    <span class="mdl-checkbox__label"><?= $this->t('{material:mfa:new_codes_saved}') ?></span>
                </label>

                <button name="continue" class="mdl-button mdl-button--raised mdl-button--primary" disabled>
                    <?= $this->t('{material:mfa:button_continue}') ?>
                </button>
            </div>

            <script>
                function toggleContinue(event) {
                    contBtn = document.querySelector('button[name="continue"]');
                    
                    contBtn.disabled = ! event.checked;  
                }
            </script>
        </form>
    </main>
</div>
</body>
</html>
