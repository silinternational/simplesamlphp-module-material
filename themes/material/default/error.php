<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:error:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>
</head>
<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header mdl-color--red">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:error:header}') ?>
            </span>
        </div>
    </header>

    <main class="mdl-layout__content" layout-children="column">
        <p><?= $this->t('{material:error:message}') ?><p>

        <?php
        if ($this->data['showerrors']) {
        ?>
        <p class="mdl-typography--body-2">
            <?= htmlspecialchars($this->data['error']['exceptionMsg']) ?>
        </p>

        <pre class="mdl-typography--caption">
            <?= htmlspecialchars($this->data['error']['exceptionTrace']) ?>
        </pre>
        <?php
        }
        ?>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
