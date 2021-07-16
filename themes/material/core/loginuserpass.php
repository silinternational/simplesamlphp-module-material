<!DOCTYPE html>
<html>
<head>
    <?php
    $idpName = htmlentities($this->configuration->getValue(
        'idp_display_name',
        $this->configuration->getValue('idp_name', '—')
    ));
    ?>

    <title><?= $this->t('{material:login:title}', ['{idpName}' => $idpName]) ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script>
        function preventDefault(event) {
            event.preventDefault();
        }
    </script>

    <?php
    $siteKey = htmlentities($this->data['recaptcha.siteKey'] ?? null);

    if (! empty($siteKey)) {
    ?>
    <script src='https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit' async defer></script>

    <script>
        function submitForm() {
            document.querySelector('form').submit();
        }

        function onRecaptchaLoad() {
            var loginButton = document.querySelector('button');

            grecaptcha.render(loginButton, {
                sitekey: '<?= $siteKey ?>',
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

        <form method="post" autocomplete="off" onsubmit="event.target.onsubmit = preventDefault">
            <input type="hidden" name="AuthState" value="<?= htmlentities($this->data['stateparams']['AuthState']) ?>" />

            <?php
            if (key_exists('csrfToken', $this->data)) {
                $csrfToken = htmlentities($this->data['csrfToken']);
                ?>
                <input type="hidden" name="csrf-token" value="<?= $csrfToken ?>" />
                <?php
            }
            ?>

            <div class="mdl-card mdl-shadow--8dp fill-phone-viewport">
                <div class="mdl-card__media white-bg margin" layout-children="column">
                    <img src="/logo.png" alt="<?= $this->t('{material:login:logo}', ['{idpName}' => $idpName]) ?>">
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

                        <?php
                        $username = htmlentities($this->data['username'] ?? null);
                        ?>
                        <input type="text" name="username" class="mdl-textfield__input" value="<?= $username ?>" 
                               <?= empty($username) ? 'autofocus' : '' ?> id="username"/>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label for="password" class="mdl-textfield__label">
                            <?= $this->t('{material:login:label_password}') ?>
                        </label>

                        <input type="password" name="password" class="mdl-textfield__input" <?= ! empty($username) ? 'autofocus' : '' ?> 
                               id="password"/>
                    </div>
                </div>

                <?php
                $errorCode = $this->data['errorcode'] ?? null;
                if ($errorCode == 'WRONGUSERPASS') {
                    $errorMessageKey = $this->data['errorparams'][1] ?? '{material:login:error_wronguserpass}';
                    $errorMessageTokens = $this->data['errorparams'][2] ?? null;

                    $message = $this->t($errorMessageKey, $errorMessageTokens);
                ?>
                <p class="mdl-card__supporting-text mdl-color-text--red error">
                    <i class="material-icons">error</i>

                    <span class="mdl-textfield mdl-typography--caption">
                        <?= htmlentities($message) ?>
                    </span>
                </p>

                <script>
                    ga('send','event','error',<?= json_encode($errorCode) ?>,'message',<?= json_encode($message) ?>);
                </script>
                <?php
                }
                ?>

                <div class="mdl-card__actions" layout-children="row">
                    <?php
                    $forgotPasswordUrl = htmlentities($this->configuration->getValue('passwordForgotUrl'));
                    if (! empty($forgotPasswordUrl)) {
                    ?>
                    <a href="<?= $forgotPasswordUrl ?>" target="_blank" class="mdl-button mdl-button--colored mdl-typography--caption">
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

            <section layout-children="row" child-spacing="space-around">
                <?php if (! empty($this->data['helpCenterUrl'])): ?>
                <a href="<?= $this->data['helpCenterUrl'] ?>" target="_blank" class="mdl-button mdl-button--colored mdl-typography--body-2">
                    <?= $this->t('{material:login:help}') ?> <i class="material-icons">launch</i>
                </a>
                <?php endif; ?>

                <?php if (! empty($this->data['profileUrl'])): ?>
                <a href="<?= $this->data['profileUrl'] ?>" target="_blank" class="mdl-button mdl-button--colored mdl-typography--body-2">
                    <?= $this->t('{material:login:profile}') ?> <i class="material-icons">launch</i>
                </a>
                <?php endif; ?>
            </section>
        </form>
    </main>
</div>
</body>
</html>
