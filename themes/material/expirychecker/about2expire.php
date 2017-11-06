<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:about2expire:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>
</head>
<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:about2expire:header}') ?>
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
            <?php
            $daysLeft = $this->data['daysLeft'] ?? 0;
            $expiringMessage = $daysLeft < 2 ?
                               $this->t('{material:about2expire:expiring_in_a_day}') :
                               $this->t('{material:about2expire:expiring_soon}',
                                        ['{daysLeft}' => $daysLeft]);
            ?>
                <?= $expiringMessage ?>
            </p>

            <p class="mdl-typography--body-1">
                <?= $this->t('{material:about2expire:change_now}') ?>
            </p>

            <div class="fill-parent" layout-children="row" child-spacing="space-around">
                <button name="continue" class="mdl-button mdl-button--raised">
                    <?= $this->t('{material:about2expire:button_continue}') ?>
                </button>

                <button name="changepwd" class="mdl-button mdl-button--raised mdl-button--primary">
                    <?= $this->t('{material:about2expire:button_change}') ?>
                </button>
            </div>
        </form>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
