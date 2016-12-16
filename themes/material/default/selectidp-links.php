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

    <main class="mdl-layout__content" layout-children="column">
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
            // in order to bypass some built-in behavior, an extra idp
            // might've been added.  It's not necessary anymore.
            unset($this->data['idplist']['dummy']);

            foreach ($this->data['idplist'] as $idp) {
                $name = htmlspecialchars($idp['name']);
                $idpId = htmlspecialchars($idp['entityid']);
            ?>
            <div class="mdl-card mdl-shadow--8dp margin">
                <div class="mdl-card__media white-bg fixed-height">
                    <button class="mdl-button fill-parent no-padding" value="<?= $name ?>"
                            onclick="setSelectedIdp('<?= $idpId ?>')">                        
                        <img src="<?= empty($idp['logoURL']) ? 
                                      '/module.php/material/default-logo.png' :
                                      $idp['logoURL'] ?>">
                    </button>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button class="mdl-button mdl-button--colored fill-parent"
                            value="<?= $name ?>"
                            onclick="setSelectedIdp('<?= $idpId ?>')">
                        <!-- div added because of https://github.com/philipwalton/flexbugs#9-some-html-elements-cant-be-flex-containers 
                             TODO: move properties to button and remove div if 
                                   these bugs are resolved. -->
                        <div layout-children="row" child-spacing="space-between">
                            <span>
                                <?= $this->t('{material:selectidp:button_login}', ['$idpName' => $name]) ?>
                            </span>

                            <i class="material-icons">exit_to_app</i>
                        </div>
                    </button>
                </div>
            </div>
            <?php
            }
            ?>

            <?php
            $futureIdps = ['sil', 'usa', 'wga'];
            foreach ($futureIdps as $futureIdp) {
            ?>
            <div class="mdl-card mdl-shadow--2dp margin disabled" title="Planned for a future release.">
                <div class="mdl-card__media white-bg fixed-height" layout-children="row" child-spacing="center">
                    <img src="//static.gtis.guru/idp-logo/<?= $futureIdp ?>-logo-disabled.png">
                </div>
                <div class="mdl-card__supporting-text" layout-children="row" child-spacing="center">
                    <?= $this->t('{material:selectidp:button_login_disabled}') ?>
                </div>
            </div>
            <?php
            }
            ?>
        </form>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
