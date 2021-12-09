<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:mfa:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <?php
    $webauthnJsFileHash = md5_file(__DIR__ . '/../../../www/simplewebauthn/browser.js');
    ?>
    <script src="simplewebauthn/browser.js?v=<?= $webauthnJsFileHash ?>"></script>

    <script>
        function verifyWebAuthn() {
            const loginChallenge = <?= \json_encode($this->data['mfaOption']['data']) ?> || {};
            SimpleWebAuthnBrowser.startAuthentication(loginChallenge.publicKey).then(submitForm).catch(handleError);
        }

        function handleError(errorMessage) {
            console.error('errorMessage', errorMessage); // TEMP
            
            const errorNode = document.querySelector('p.error');

            errorNode.classList.remove('hide');
            errorNode.querySelector('span').textContent = errorMessage;

            offerRetry();
        }

        function offerRetry() {
            const retryButton = document.querySelector('.mdl-button.mdl-color-text--red');

            retryButton.classList.remove('hide');
        }

        function submitForm(webAuthnResponse) {
            const form = document.querySelector('form');
            const submissionInput  = createHiddenInput('submitMfa');
            const webAuthnResponseInput = createHiddenInput('mfaSubmission');

            webAuthnResponseInput.value = JSON.stringify(webAuthnResponse);

            form.appendChild(submissionInput);
            form.appendChild(webAuthnResponseInput);

            form.submit();
        }

        function createHiddenInput(name) {
            const input = document.createElement('input');

            input.type = 'hidden';
            input.name = name;

            return input;
        }
    </script>
</head>

<?php $isWebAuthnSupported = $this->data['supportsWebAuthn']; ?>

<body class="gradient-bg" onload="<?= $isWebAuthnSupported ? 'verifyWebAuthn()' : '' ?>">
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
                    <img src="mfa-webauthn.svg" alt="<?= $this->t('{material:mfa:webauthn_icon}') ?>"
                         class="icon">
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:mfa:webauthn_header}') ?>
                    </h1>
                </div>

                <?php if ($isWebAuthnSupported): ?>
                <div class="mdl-card__title">
                    <p class="mdl-card__subtitle-text">
                        <?= $this->t('{material:mfa:webauthn_instructions}') ?>
                    </p>
                </div>
                <?php else: ?>
                <div class="mdl-card__title">
                    <p class="mdl-typography--text-center mdl-color-text--red">
                        <?= $this->t('{material:mfa:webauthn_unsupported}') ?>
                    </p>
                </div>
                <?php endif; ?>

                <?php
                $message = $this->data['errorMessage'];
                if (! empty($message)) {
                    ?>
                    <script>
                        ga('send','event','error','webauthn',<?= \json_encode($message) ?>);
                    </script>
                    <?php
                }
                ?>
                <div class="mdl-card__supporting-text" layout-children="column">
                    <p class="mdl-color-text--red error <?= ! empty($message) ? 'show' : 'hide' ?>">
                        <i class="material-icons">error</i>

                        <span class="mdl-typography--caption">
                            <?= htmlentities($message) ?>
                        </span>
                    </p>
                </div>

                <div class="mdl-card__actions" layout-children="row">
                    <span flex></span>
                    <!-- used type=button to avoid form submission on click -->
                    <button type="button" onclick="verifyWebAuthn()"
                           class="mdl-button mdl-color-text--red <?= ! empty($message) ? 'show' : 'hide' ?>">
                        <?= $this->t('{material:mfa:button_try_again}') ?>
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
