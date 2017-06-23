<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:logout:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>
</head>
<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:logout:header}') ?>
            </span>
        </div>
    </header>

    <main class="mdl-layout__content margin" layout-children="column">
        <p>
            <?= $this->t('{material:logout:message}') ?>
        </p>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
