<!DOCTYPE html>
<?php
    $siteKey = $this->data['recaptcha.siteKey'] ?? null;
    $username = $this->data['username'] ?? null;
    $forgotPasswordUrl = $this->data['forgotPasswordUrl'] ?? null;
    $csrfToken = $this->data['csrfToken'] ?? null;
    $idpName = $this->configuration->getValue('idp_name', '—');

    $errorCode = $this->data['errorcode'] ?? null;
    $errorMessageKey = $this->data['errorparams'][1] ?? '{material:login:error_wronguserpass}';
    $errorMessageTokens = $this->data['errorparams'][2] ?? [];
?>
<html>
<head>
    <title><?= $this->t('{material:login:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <?php
    if (! empty($siteKey)) {
    ?>
    <script src='https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit'
            async defer></script>

    <script>
        function submitForm() {
            document.querySelector('form').submit();
        }

        function onRecaptchaLoad() {
            var loginButton = document.querySelector('button');

            grecaptcha.render(loginButton, {
                sitekey: '<?= htmlentities($siteKey) ?>',
                callback: submitForm
            });
        }

        ga('send', 'event', 'reCAPTCHA', 'required');
    </script>
    <?php
    }
    ?>
</head>
<body class="gradient-bg">
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <main class="mdl-layout__content" layout-children="column" child-spacing="center">
        <?php include __DIR__ . '/../common-announcement.php' ?>

        <form method="POST" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>">
            <input type="hidden" name="AuthState"
                   value="<?= htmlspecialchars($this->data['stateparams']['AuthState']) ?>" />
            <input type="hidden" name="csrf-token" value="<?= htmlentities($csrfToken); ?>" />

            <div class="mdl-card mdl-shadow--8dp">
                <div class="mdl-card__media white-bg margin" layout-children="column">
                    <img src="/logo.png"
                         alt="<?= $this->t('{material:login:logo}', ['{idpName}' => $idpName]) ?>">
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:login:header}', ['{idpName}' => $idpName]) ?>
                    </h1>
                </div>

                <div class="mdl-card__supporting-text" layout-children="column">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label for="username" class="mdl-textfield__label">
                            <?= $this->t('{material:login:label_username}') ?>
                        </label>
                        <input type="text" name="username" class="mdl-textfield__input"
                               value="<?= htmlspecialchars($username) ?>"
                               <?= empty($username) ? 'autofocus' : '' ?> id="username"/>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label for="password" class="mdl-textfield__label">
                            <?= $this->t('{material:login:label_password}') ?>
                        </label>
                        <input type="password" name="password" class="mdl-textfield__input"
                               <?= ! empty($username) ? 'autofocus' : '' ?> id="password"/>
                    </div>
                </div>

                <?php
                if ($errorCode == 'WRONGUSERPASS') {
                    $message = $this->t($errorMessageKey, $errorMessageTokens);
                ?>
                <p class="mdl-color-text--red error">
                    <i class="material-icons">error</i>

                    <span class="mdl-textfield mdl-typography--caption">
                        <?= $message ?>
                    </span>
                </p>

                <script>
                    ga('send','event','error','<?= $errorCode ?>','<?= $username ?>','<?= $message ?>');
                </script>
                <?php
                }
                ?>

                <div class="mdl-card__actions" layout-children="row">
                    <?php
                    if (! empty($forgotPasswordUrl)) {
                    ?>
                    <a href="<?= htmlentities($forgotPasswordUrl) ?>" target="_blank"
                       class="mdl-button mdl-button--colored mdl-typography--caption">
                        <?= $this->t('{material:login:forgot}') ?>
                    </a>
                    <?php
                    }
                    ?>

                    <span flex></span>

                    <button class="mdl-button mdl-button--colored mdl-button--raised">
                        <?= $this->t('{material:login:button_login}') ?>
                    </button>
                </div>
            </div>
        </form>
    </main>
</div>
</body>
</html>
