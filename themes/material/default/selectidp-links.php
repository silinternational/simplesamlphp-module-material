<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:selectidp:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script>
        function setSelectedIdp(id) {
            var idpInput = document.createElement('input');

            idpInput.type = 'hidden';
            idpInput.name = '<?= htmlspecialchars($this->data['returnIDParam']) ?>';
            idpInput.value = id;

            document.querySelector('form').appendChild(idpInput);

            ga('send', 'event', 'hub', 'choice', 'IdP', id);
        }
    </script>
</head>

<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:selectidp:header}') ?>
            </span>
        </div>
    </header>

    <main class="mdl-layout__content">
        <?php include __DIR__ . '/../common-announcement.php' ?>

        <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>"
              layout-children="row" child-spacing="space-around">
            <input type="hidden" name="entityID"
                   value="<?= htmlspecialchars($this->data['entityID']) ?>" />
            <input type="hidden" name="return"
                   value="<?= htmlspecialchars($this->data['return']) ?>" />
            <input type="hidden" name="returnIDParam"
                   value="<?= htmlspecialchars($this->data['returnIDParam']) ?>" />

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
                $name = htmlspecialchars($this->t($idp['name']));
                $idpId = htmlspecialchars($idp['entityid']);
                $hoverText = $this->t('{material:selectidp:enabled}', ['{idpName}' => $name]);
            ?>
            <div class="mdl-card mdl-shadow--8dp row-aware" title="<?= $hoverText ?>">
                <div class="mdl-card__media white-bg fixed-height">
                    <button class="mdl-button fill-parent" value="<?= $name ?>"
                            onclick="setSelectedIdp('<?= $idpId ?>')">
                        <img class="scale-to-parent"
                             src="<?= empty($idp['logoURL']) ? '/module.php/material/default-logo.png'
                                                             : $idp['logoURL'] ?>">
                    </button>
                </div>
            </div>
            <?php
            }
            ?>

            <?php
            foreach ($disabledIdps as $idp) {
                $name = htmlspecialchars($this->t($idp['name']));
                $hoverText = $this->t('{material:selectidp:disabled}', ['{idpName}' => $name]);
            ?>
            <div class="mdl-card mdl-shadow--2dp disabled row-aware" title="<?= $hoverText ?>">
                <div class="mdl-card__media white-bg fixed-height" layout-children="row"
                     child-spacing="center">
                    <img class="scale-to-parent"
                         src="<?= empty($idp['logoURL']) ? '/module.php/material/default-logo.png'
                                                         : $idp['logoURL'] ?>">
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
</html>
