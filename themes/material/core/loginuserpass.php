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
<body>
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

            <div class="container fill-phone-viewport">
                <!-- TODO add to config? -->
                <svg width="24" height="49" viewBox="0 0 24 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 48.998V28.1825C12 27.0779 12.8954 26.1825 14 26.1825H22C23.1046 26.1825 24 25.287 24 24.1825V17.8292H7.13684C3.82313 17.8292 1.13684 20.5155 1.13684 23.8292V48.998H12ZM6.94737 13.5903C8.96842 13.5903 10.6316 13.0292 11.9368 11.9071C13.2421 10.7435 13.8947 9.22662 13.8947 7.35649C13.8947 5.48636 13.2421 3.96947 11.9368 2.80584C10.6316 1.60064 8.96842 0.998047 6.94737 0.998047C4.92632 0.998047 3.26316 1.60064 1.9579 2.80584C0.652633 3.96947 0 5.48636 0 7.35649C0 9.22662 0.652633 10.7435 1.9579 11.9071C3.26316 13.0292 4.92632 13.5903 6.94737 13.5903Z" fill="black"/>
                </svg>

                <h4 class="app-title">Verily</h4>

                <div class="sp-header">
                    <img src="/logo.png" class="logo" alt="<?= $this->t('{material:login:logo}', ['{idpName}' => $idpName]) ?>">

                    <?= $this->t('{material:login:header}', ['{idpName}' => $idpName]) ?>
                </div>

                <div class="" layout-children="column">
                    <label class="custom-field">
                        <?php
                        $username = htmlentities($this->data['username'] ?? null);
                        ?>
                        <input type="text" name="username" required value="<?= $username ?>" 
                            <?= empty($username) ? 'autofocus' : '' ?> id="username"/>
                        <span class="placeholder"><?= $this->t('{material:login:label_username}') ?></span>
                    </label>

                    <label class="custom-field">
                        <input type="password" name="password" required <?= ! empty($username) ? 'autofocus' : '' ?> 
                                id="password"/>
                        <span class="placeholder"><?= $this->t('{material:login:label_password}') ?></span>
                    </label>
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

<style>
    *, *::before, *::after {
        box-sizing: border-box;
    }
    .custom-field {
        font-size: 14px;
        position: relative;
        --field-padding: 12px;
        border-top: 20px solid transparent;
    }
    .custom-field input {
        border: none;
        -webkit-appearance: none;
        -ms-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background: hsla(213, 29%, 97%, 1);
        padding: 12px;
        border-radius: 3px;
        width: 250px;
        font-size: 14px;
        padding: var(--field-padding);
    }   
    .custom-field .placeholder {
        position: absolute;
        left: 12px;
        top: 22px;  
        transform: translateY(-50%);
        width: calc(100% - 24px);  
        color: #aaa;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        left: var(--field-padding);
        width: calc(100% - (var(--field-padding) * 2));
        transition: 
        top 0.3s ease,
        color 0.3s ease,
        font-size 0.3s ease;
    }
    .custom-field input:not(:placeholder-shown) + .placeholder
    .custom-field input:focus + .placeholder {
        top: -10px;
        font-size: 10px;
        color: #222;
    }
    .custom-field input:focus + .placeholder {
        top: -10px;
        font-size: 10px;
        color: #222;
    }

    .container {
        border: 1px solid hsla(196, 8%, 18%, 0.1);
        border-radius: 12px;
        padding: 14px;
        margin: 14px;
        background: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .logo {
        max-width: 40px;
        max-height: 40px;
        margin: 8px 16px 8px 8px;
    }
    .sp-header {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .app-title {
        text-align: center;
        color: #2A3032;
        margin: .3rem;
        margin: 8px;
    }
</style>