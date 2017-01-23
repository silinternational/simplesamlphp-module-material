<!DOCTYPE html>
<?php
    $siteKey = $this->data['recaptcha.siteKey'] ?? null;
    $username = $this->data['username'] ?? null;
    $forgotPasswordUrl = $this->data['forgotPasswordUrl'] ?? null;

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
    <script src='https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit' async defer></script>

    <script>
        function onSubmit() {
            document.querySelector('form').submit();
        }

        function onRecaptchaLoad() {
            var loginButton = document.querySelector('button');

            grecaptcha.render(loginButton, {
                sitekey: '<?= htmlentities($siteKey) ?>',
                callback: onSubmit
            });
        }
    </script>
    <?php
    }
    ?>

</head>
<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:login:header}') ?>
            </span>
        </div>
    </header>

    <main class="mdl-layout__content">
        <form method="POST" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" 
              layout-children="column">
            <?php include __DIR__ . '/../common-announcement.php' ?>

            <input type="hidden" name="AuthState" 
                   value="<?= htmlspecialchars($this->data['stateparams']['AuthState']) ?>" />

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="username" class="mdl-textfield__label">
                    <?= $this->t('{material:login:label_username}') ?>
                </label>
                <input type="text" name="username" class="mdl-textfield__input" 
                       value="<?= htmlspecialchars($username) ?>" 
                       <?= empty($username) ? 'autofocus' : '' ?> />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="password" class="mdl-textfield__label">
                    <?= $this->t('{material:login:label_password}') ?>
                </label>
                <input type="password" name="password" class="mdl-textfield__input" 
                       <?= ! empty($username) ? 'autofocus' : '' ?> />
            </div>
        
            <?php
            if ($errorCode == 'WRONGUSERPASS') {
            ?>
            <p class="mdl-color-text--red" layout-children="row" 
               child-spacing="space-between">
                <i class="material-icons">error</i>

                <span class="mdl-textfield mdl-typography--caption margin">
                    <?= $this->t($errorMessageKey, $errorMessageTokens) ?>
                </span>
            </p>
            <?php
            }
            ?>

            <button class="mdl-button mdl-button--colored mdl-button--raised">
                <?= $this->t('{material:login:button_login}') ?>
            </button>

            <?php 
            if (! empty($forgotPasswordUrl)) { 
            ?>
            <p class="mdl-typography--caption margin">
                <a href="<?= htmlentities($forgotPasswordUrl) ?>" 
                   target="_blank">
                    <?= $this->t('{material:login:forgot}') ?>
                </a>
            <p>
            <?php 
            } 
            ?>
        </form>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
