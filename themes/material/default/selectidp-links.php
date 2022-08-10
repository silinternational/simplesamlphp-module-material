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
<div class="mdl-layout fill-viewport">

    <div class="mdl-layout-spacer"></div>

    <?php if (! empty($this->data['helpCenterUrl'])): ?>
        <nav class="mdl-navigation">
            <a href="<?= $this->data['helpCenterUrl'] ?>" target="_blank" class="mdl-navigation__link">
                <?= $this->t('{material:selectidp:help}') ?>
            </a>
        </nav>
    <?php endif; ?>


    <main class="mdl-layout__content">
        <?php include __DIR__ . '/../common-announcement.php' ?>

        <form layout-children="row" child-spacing="space-around">
            <input type="hidden" name="entityID"
                   value="<?= htmlentities($this->data['entityID']) ?>" />
            <input type="hidden" name="return"
                   value="<?= htmlentities($this->data['return']) ?>" />
            <input type="hidden" name="returnIDParam"
                   value="<?= htmlentities($this->data['returnIDParam']) ?>" />
            <div class="container">
                <!-- TODO add logo from config? -->
                <img src="" class="logo" />
                <!-- TODO add and get app name from config? -->
                <h4 class="app-title">Verily</h4>

                <div class="list-header">
                    <?php
                    $spName = $this->data['spName'] ?? null;
                    if (empty($spName)) {
                        echo $this->t('{material:selectidp:header}');
                    } else {
                        echo htmlentities($this->t('{material:selectidp:header-for-sp}', ['{spName}' => $spName]));
                    }
                    ?>
                </div>

                <ul>
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
                <li>
                    <button class="fill-parent" onclick="setSelectedIdp('<?= $idpId ?>')" title="<?= $hoverText ?>">
                        <div class="content">
                            <img id="<?= $idpId ?>" class="avatar" src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                                    : $idp['logoURL'] ?>" />
                            <?= $name ?>
                        </div>
                    </button>
                </li>
                <?php
                }
                ?>
                </ul>
            </div>

            <div class="container">
                <div class="list-header">Coming soon</div>
                <ul>
                    
                <?php
                foreach ($disabledIdps as $idp) {
                    $name = htmlentities($this->t($idp['name']));
                    $idpId = htmlentities($idp['entityid']);
                    $hoverText = $this->t('{material:selectidp:disabled}', ['{idpName}' => $name]);
                ?>

                <li>
                    <button onclick="clickedAnyway('<?= $name ?>')" class="disabled" title="<?= $hoverText ?>">
                        <div class="content">
                            <img id="<?= $idpId ?>" class="avatar" src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                                    : $idp['logoURL'] ?>" />
                            <?= $name ?>
                        </div>
                    </button>
                </li>
                <?php
                }
                ?>
                </ul>
            </div>
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
<style>
    .avatar {
        max-width: 40px;
        max-height: 40px;
        margin: 8px 16px 8px 8px;
    }
    .container {
        border: 1px solid hsla(196, 8%, 18%, 0.1);
        border-radius: 12px;
        padding: 14px;
        margin: 14px;
    }
    .content {
        display: flex;
        min-height: 50px;
        flex-direction: row;
        align-items: center;
        width: 240px;
        margin: 0 4px 1px 4px;
    }
    .disabled {
        opacity: 0.7;
    }
    .disabled:hover {
        cursor: not-allowed;
        background-color: #f5f5f5;
    }
    ul {
        list-style: none;
        background-color: white;
        padding: initial;
        border-bottom: 1px solid hsla(196, 8%, 18%, 0.1);
    }
    button:hover {
        cursor: pointer;
        background-color: #f5f5f5;
    }
    button {
        border: 1px solid hsla(196, 8%, 18%, 0.1);
        margin-top: -1px;
        background-color: white;
    }
    .list-header {
        margin: 1rem;
        text-align: center;
        color: hsla(213, 8%, 46%, 1);
        margin: .5rem;
    }
    .app-title {
        text-align: center;
        color: #2A3032;
        margin: .3rem;
    }
</style>