<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:mfa:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>
</head>
<body class="gradient-bg">
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:mfa:header}') ?>
            </span>
        </div>
    </header>
    <main class="mdl-layout__content" layout-children="column">
        <form layout-children="column" method="post" autocomplete="off">
            <div class="mdl-card mdl-shadow--8dp">
                <div class="mdl-card__media white-bg margin" layout-children="column">
                    <img src="mfa-manager.svg" class="icon" alt="<?= $this->t('{material:mfa:manager_icon}') ?>">
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:mfa:manager_header}') ?>
                    </h1>
                </div>

                <div class="mdl-card__title center">
                    <p class="mdl-card__subtitle-text">
                        <?= $this->t('{material:mfa:manager_info}', ['{managerEmail}' => $this->data['managerEmail']]) ?>
                    </p>
                </div>

                <div class="mdl-card__actions" layout-children="row">
                <button name="cancel" class="mdl-button mdl-button--primary">
                        <?= $this->t('{material:mfa:button_cancel}') ?>
                    </button>
                    <span flex></span>

                    <button name="send" class="mdl-button mdl-button--raised mdl-button--primary">
                        <?= $this->t('{material:mfa:button_send}') ?>
                    </button>
                </div>
            </div>
        </form>
    </main>
</div>
</body>
</html>
