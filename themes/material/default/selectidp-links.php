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
                <svg width="24" height="49" viewBox="0 0 24 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 48.998V28.1825C12 27.0779 12.8954 26.1825 14 26.1825H22C23.1046 26.1825 24 25.287 24 24.1825V17.8292H7.13684C3.82313 17.8292 1.13684 20.5155 1.13684 23.8292V48.998H12ZM6.94737 13.5903C8.96842 13.5903 10.6316 13.0292 11.9368 11.9071C13.2421 10.7435 13.8947 9.22662 13.8947 7.35649C13.8947 5.48636 13.2421 3.96947 11.9368 2.80584C10.6316 1.60064 8.96842 0.998047 6.94737 0.998047C4.92632 0.998047 3.26316 1.60064 1.9579 2.80584C0.652633 3.96947 0 5.48636 0 7.35649C0 9.22662 0.652633 10.7435 1.9579 11.9071C3.26316 13.0292 4.92632 13.5903 6.94737 13.5903Z" fill="black"/>
                </svg>
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
        display: flex;
        flex-direction: column;
        align-items: center;
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
        margin: 8px;
    }
</style>