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
        <form layout-children="column" method="post">
            <div class="mdl-card mdl-shadow--8dp">
                <div class="mdl-card__media white-bg margin" layout-children="column">
                    <i class="mdl-color-text--red error material-icons mdl-typography--display-4">error</i>
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:mfa:no_more_codes_header}') ?>
                    </h1>
                </div>

                <div class="mdl-card__title center" >
                    <p class="mdl-card__subtitle-text">
                        <?php if ($this->data['hasOtherMfaOptions']): ?>
                        <?= $this->t('{material:mfa:has_options_besides_codes}') ?>
                        <?php else: ?>
                        <?= $this->t('{material:mfa:has_no_more_options}') ?>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="mdl-card__actions" layout-children="row">
                    <?php if ($this->data['hasOtherMfaOptions']): ?>
                    <button name="continue" class="mdl-button">
                        <?= $this->t('{material:mfa:button_later}') ?>
                    </button>
                    <?php endif; ?>

                    <span flex></span>

                    <button name="getMore" class="mdl-button mdl-button--raised mdl-button--primary">
                        <?= $this->t('{material:mfa:button_get_more}') ?>
                    </button>
                </div>
            </div>
        </form>
    </main>
</div>
</body>
</html>
