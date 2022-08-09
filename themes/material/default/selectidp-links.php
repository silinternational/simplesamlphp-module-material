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
            
            <ul class="">
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
            
            <li onclick="setSelectedIdp('<?= $idpId ?>')" class="list_item" title="<?= $hoverText ?>">
                <div class="content">
                    <img id="<?= $idpId ?>" class="avatar" src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                            : $idp['logoURL'] ?>" />
                    <?= $name ?>
                </div>
            </li>

            <?php
            }
            ?>
            </ul>

            <ul class="">
                <?php
            foreach ($disabledIdps as $idp) {
                $name = htmlentities($this->t($idp['name']));
                $idpId = htmlentities($idp['entityid']);
                $hoverText = $this->t('{material:selectidp:disabled}', ['{idpName}' => $name]);
            ?>

            <li onclick="clickedAnyway('<?= $name ?>')" class="list_item disabled" title="<?= $hoverText ?>">
                <div class="content">
                    <img id="<?= $idpId ?>" class="avatar" src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                            : $idp['logoURL'] ?>" />
                    <?= $name ?>
                </div>
            </li>
            <?php
            }
            ?>
            </ul>
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
    .disabled {
        opacity: 0.7;
    }
    .disabled:hover {
        cursor: not-allowed;
        background-color: #f5f5f5;
    }
    ul {
        list-style: none;
        border: 1px solid #DDDDDD;
        background-color: white;
        border-radius: 8px;
        padding: 14px;
    }
    li:hover {
        cursor: pointer;
        background-color: #f5f5f5;
    }
    .content {
        display: flex;
        min-height: 50px;
        flex-direction: row;
        align-items: center;
        width: 240px;
        margin: 0 4px 1px 4px;
    }
    .list_item {
        border: 1px solid rgba(42, 48, 50, 20%);
        margin-top: -1px;
    }
    .avatar {
        max-width: 40px;
        max-height: 40px;
        margin: 8px 16px 8px 8px;
    }
</style>