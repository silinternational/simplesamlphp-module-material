<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:mfa:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script src="mfa-u2f-api.js"></script>

    <script>
        function verifyU2f() {
            var u2fSignRequest = <?= json_encode($this->data['mfaOption']['data']) ?> || {};

            u2f.sign(u2fSignRequest.appId, u2fSignRequest.challenge, [u2fSignRequest], handleU2fResponse);
        }

        function handleU2fResponse(u2fResponse) {
            if (isU2fError(u2fResponse)) {
                return handleError(u2fResponse);
            }

            submitForm(u2fResponse);
        }

        /**
         * @param {u2f.Error|u2f.SignResponse=} response
         */
        function isU2fError (response) {
            return !!response.errorCode;
        }

        /**
         * @param {u2f.Error=} error
         */
        function handleError(error) {
            var message = error.errorMessage || createMessage(error.errorCode);

            var errorNode = document.querySelector('p.error');

            errorNode.classList.remove('hide');
            errorNode.querySelector('span').textContent = message;

            offerRetry();
        }

        /**
         * https://developers.yubico.com/U2F/Libraries/Client_error_codes.html
         * @param {u2f.ErrorCodes=} code
         */
        function createMessage (code) {
            switch (code) {
                case 1:
                case 2:
                case 3: return <?= json_encode($this->t('{material:mfa:u2f_error_unknown}')) ?>;
                case 4: return <?= json_encode($this->t('{material:mfa:u2f_error_wrong_key}')) ?>;
                case 5: return <?= json_encode($this->t('{material:mfa:u2f_error_timeout}')) ?>;
            }
        }

        function offerRetry() {
            var retryButton = document.querySelector('.mdl-button.mdl-color-text--red');

            retryButton.classList.remove('hide');
        }

        function submitForm(u2fResponse) {
            var form = document.querySelector('form');
            var submissionInput  = createHiddenInput('submitMfa');
            var u2fResponseInput = createHiddenInput('mfaSubmission');

            u2fResponseInput.value = JSON.stringify(u2fResponse);

            form.appendChild(submissionInput);
            form.appendChild(u2fResponseInput);

            form.submit();
        }

        function createHiddenInput(name) {
            var input = document.createElement('input');

            input.type = 'hidden';
            input.name = name;

            return input;
        }
    </script>
</head>

<?php $isU2fSupported = $this->data['supportsU2f']; ?>

<body class="gradient-bg" onload="<?= $isU2fSupported ? 'verifyU2f()' : '' ?>">
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
                    <img src="mfa-u2f.svg" alt="<?= $this->t('{material:mfa:u2f_icon}') ?>"
                         class="icon">
                </div>

                <div class="mdl-card__title center">
                    <h1 class="mdl-card__title-text">
                        <?= $this->t('{material:mfa:u2f_header}') ?>
                    </h1>
                </div>

                <?php if ($isU2fSupported): ?>
                <div class="mdl-card__title">
                    <p class="mdl-card__subtitle-text">
                        <?= $this->t('{material:mfa:u2f_instructions}') ?>
                    </p>
                </div>
                <?php else: ?>
                <div class="mdl-card__title">
                    <p class="mdl-typography--text-center mdl-color-text--red">
                        <?= $this->t('{material:mfa:u2f_unsupported}') ?>
                    </p>
                </div>
                <?php endif; ?>

                <?php
                $message = $this->data['errorMessage'];
                if (! empty($message)) {
                ?>
                <script>
                    ga('send','event','error','u2f',<?= json_encode($message) ?>);
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
                    <button type="button" onclick="verifyU2f()"
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
