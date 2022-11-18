<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:selectidp:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script>
        function setSelectedIdp(id) {
            var idpInput = document.createElement('input');

            idpInput.type = 'hidden';
            idpInput.name = <?= json_encode($this->data['returnIDParam'], JSON_HEX_TAG) ?>;
            idpInput.value = id;

            document.querySelector('form').appendChild(idpInput);

            ga('send', 'event', 'hub', 'choice', 'IdP', id);
        }

        function clickedAnyway(idpName) {
            ga('send', 'event', 'hub', 'choice-disabled', 'IdP', idpName);
        }
    </script>
</head>

<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
            <?php
            $spName = $this->data['spName'] ?? null;
            if (empty($spName)) {
                echo $this->t('{material:selectidp:header}');
            } else {
                echo htmlentities($this->t('{material:selectidp:header-for-sp}', ['{spName}' => $spName]));
            }
            ?>
            </span>

            <div class="mdl-layout-spacer"></div>

            <?php if (! empty($this->data['helpCenterUrl'])): ?>
                <nav class="mdl-navigation">
                    <a href="<?= $this->data['helpCenterUrl'] ?>" target="_blank" class="mdl-navigation__link">
                        <?= $this->t('{material:selectidp:help}') ?>
                    </a>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <main class="mdl-layout__content">
        <?php include __DIR__ . '/../common-announcement.php' ?>

        <form layout-children="row" child-spacing="space-around">
            <input type="hidden" name="entityID"
                   value="<?= htmlentities($this->data['entityID']) ?>" />
            <input type="hidden" name="return"
                   value="<?= htmlentities($this->data['return']) ?>" />
            <input type="hidden" name="returnIDParam"
                   value="<?= htmlentities($this->data['returnIDParam']) ?>" />

            <?php
            // in order to bypass some built-in simplesaml behavior, an extra idp
            // might've been added.  It's not meant to be displayed.
            unset($this->data['idplist']['dummy']);

            $enabledIdps = [];
            $disabledIdps = [];
            foreach ($this->data['idplist'] as $idp) {
                $idp['enabled'] === true ? array_push($enabledIdps, $idp)
                                         : array_push($disabledIdps, $idp);
            }

            foreach ($enabledIdps as $idp) {
                $name = htmlentities($this->t($idp['name']));
                $idpId = htmlentities($idp['entityid']);
                $hoverText = $this->t('{material:selectidp:enabled}', ['{idpName}' => $name]);
            ?>
            <div class="mdl-card mdl-shadow--8dp row-aware" title="<?= $hoverText ?>">
                <div class="mdl-card__media white-bg fixed-height">
                    <button class="mdl-button logo-container fill-parent" onclick="setSelectedIdp('<?= $idpId ?>')">
                        <div class="image-wrapper">
                            <img class="logo" id="<?= $idpId ?>"
                                src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                                : $idp['logoURL'] ?>">
                        </div>

                        <span class="mdl-color-text--grey-600 logo-caption clickable-caption"><?= empty($idp['logoCaption']) ? '<br>': $idp['logoCaption'] ?> </span>
                    </button>
                </div>
            </div>
            <?php
            }
            ?>

            <?php
            foreach ($disabledIdps as $idp) {
                $name = htmlentities($this->t($idp['name']));
                $idpId = htmlentities($idp['entityid']);
                $hoverText = $this->t('{material:selectidp:disabled}', ['{idpName}' => $name]);
            ?>
            <div class="mdl-card mdl-shadow--2dp disabled row-aware" title="<?= $hoverText ?>"
                 onclick="clickedAnyway('<?= $name ?>')">
                <div class="mdl-card__media white-bg fixed-height" layout-children="row" child-spacing="center">
                    <div class="logo-container fill-parent">
                        <div class="image-wrapper">
                            <img class="logo" id="<?= $idpId ?>"
                                src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                                : $idp['logoURL'] ?>">
                        </div>
                        <span class="mdl-color-text--grey-600 logo-caption" ><?= empty($idp['logoCaption']) ? '<br>': htmlentities($idp['logoCaption']) ?> </span>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </form>
    </main>

    <script>
        ga('send', 'event', 'hub', 'choices', 'enabled', <?= count($enabledIdps) ?>);
        ga('send', 'event', 'hub', 'choices', 'disabled', <?= count($disabledIdps) ?>);
    </script>
    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
<style>
    .image-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 130px;
    }
    .logo-caption {
        font-size: 1.5rem;
    }
    @media only screen and (max-width: 1200px) {
        .logo-caption {
            font-size: 1.2rem;
        }
    }
    .logo-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
    }
    .mdl-button:hover > .clickable-caption {
        color: #004F9E !important;
    }
    .mdl-card {
        border-radius: 8px;
    }
    .logo {
        max-height: 130px;
        max-width: 90%;
        padding-top: 4px;
    }
</style>
</html>
