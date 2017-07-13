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
<!--TODO: do we need ?? null on these data[] retrievals as done in other pages? Test what happens when the key is altered to a nonexistent name -->
    <main class="mdl-layout__content" layout-children="column">
<!--        TODO: since this is just a GET back to itself, I don't think action is needed at all...need to test in other browsers to make sure though. -->
        <form action="<?= htmlentities($this->data['formTarget']); ?>" layout-children="column">
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

            <button type="submit" name="changepwd"
                    class="mdl-button mdl-button--raised mdl-button--primary">
                <?= $this->t('{material:expired:button_change}') ?>
            </button>
        </form>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
