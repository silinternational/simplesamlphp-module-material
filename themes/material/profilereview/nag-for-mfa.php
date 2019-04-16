<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:nag:mfa_title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>
</head>
<body class="gradient-bg">
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:nag:mfa_header}') ?>
            </span>
        </div>
    </header>
    <main class="mdl-layout__content" layout-children="column">
        <form layout-children="column" method="post">
            <div class="mdl-card mdl-shadow--8dp">
                <div class="mdl-card__media white-bg margin" layout-children="column">
                    <img src="shield.svg" alt="<?= $this->t('{material:nag:shield_icon}') ?>">
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:nag:header}') ?>
                    </h1>
                </div>

                <div class="mdl-card__title center" >
                    <p class="mdl-card__subtitle-text">
                        <?= $this->t('{material:nag:mfa_info}') ?>
                    </p>
                </div>

                <div class="mdl-card__actions" layout-children="row" child-spacing="space-around">
                    <button name="continue" class="mdl-button">
                        <?= $this->t('{material:nag:button_later}') ?>
                    </button>

                    <span flex></span>

                    <?php
                    $url = $this->data['mfaLearnMoreUrl'] ?? null;
                    if (! empty($url)) {
                    ?>
                    <a href="<?= htmlentities($url) ?>" target="_blank" class="mdl-button mdl-button--primary margin">
                        <?= $this->t('{material:nag:button_learn_more}') ?>
                    </a>
                    <?php
                    }
                    ?>

                    <button name="update" class="mdl-button mdl-button--raised mdl-button--primary">
                        <?= $this->t('{material:nag:button_enable}') ?>
                    </button>
                </div>
            </div>
        </form>
    </main>
</div>
</body>
</html>
