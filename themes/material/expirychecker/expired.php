<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:expired:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>
</head>
<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header mdl-color--red">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:expired:header}') ?>
            </span>
        </div>
    </header>
    <main class="mdl-layout__content" layout-children="column">
        <form layout-children="column">
            <?php
            foreach ($this->data['formData'] as $name => $value) {
            ?>
            <input type="hidden" name="<?= htmlentities($name); ?>"
                   value="<?= htmlentities($value); ?>"/>
            <?php
            }
            ?>

            <p class="mdl-typography--title margin">
                <?= $this->t('{material:expired:expired}')  ?>
            </p>

            <button name="changepwd" class="mdl-button mdl-button--raised mdl-button--primary">
                <?= $this->t('{material:expired:button_change}') ?>
            </button>
        </form>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
