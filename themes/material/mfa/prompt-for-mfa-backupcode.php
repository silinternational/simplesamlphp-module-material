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
                    <img src="mfa-backupcode.svg" class="icon"
                         alt="<?= $this->t('{material:mfa:backupcode_icon}') ?>">
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:mfa:backupcode_header}') ?>
                    </h1>
                </div>

                <div class="mdl-card__title center" >
                    <p class="mdl-card__subtitle-text">
                        <?= $this->t('{material:mfa:backupcode_reminder}') ?>
                    </p>
                </div>

                <div class="mdl-card__supporting-text" layout-children="column">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label for="mfaSubmission" class="mdl-textfield__label">
                            <?= $this->t('{material:mfa:backupcode_input}') ?>
                        </label>
                        <input name="mfaSubmission" class="mdl-textfield__input mdl-color-text--black" autofocus
                               id="mfaSubmission" />
                    </div>
                </div>

                <?php
                $message = $this->data['errorMessage'];

                if (! empty($message)) {
                ?>
                <div class="mdl-card__supporting-text" layout-children="column">
                    <p class="mdl-color-text--red error">
                        <i class="material-icons">error</i>

                        <span class="mdl-typography--caption">
                            <?= htmlentities($message) ?>
                        </span>
                    </p>
                </div>

                <script>
                    ga('send','event','error','backupcode',<?= json_encode($message) ?>);
                </script>
                <?php
                }
                ?>

                <div class="mdl-card__actions" layout-children="row">
                    <span flex></span>
                    <button name="submitMfa"
                            class="mdl-button mdl-button--raised mdl-button--primary">
                        <?= $this->t('{material:mfa:button_verify}') ?>
                    </button>
                </div>

                <?php include __DIR__ . '/other_mfas.php' ?>
            </div>

            <div>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                    <span class="mdl-checkbox__label">
                        <?= $this->t('{material:mfa:remember_this}') ?>
                    </span>
                    <input type="checkbox" name="rememberMe" checked class="mdl-checkbox__input"/>
                </label>
            </div>
        </form>
    </main>
</div>
</body>
</html>
