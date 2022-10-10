<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:selectidp:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script>
        function selectPrevious(event) {
            event.preventDefault();
            var grandParent = event.target.parentNode.parentNode;
            var sibling = grandParent.previousElementSibling;
            var button = sibling.getElementsByClassName("mdl-button")[0];
            button?.click();
        }
        function selecteNext (event) {
            event.preventDefault();
            var grandParent = event.target.parentNode.parentNode;
            var sibling = grandParent.nextElementSibling;
            var button = sibling.getElementsByClassName("mdl-button")[0];
            button?.click();
        }
        function toggleButtonDisplay(event, id) {
            event.preventDefault();
            const button = document.getElementById(`btns-${id}`);
            if (button.style.display === 'none') {
                button.style.display = 'flex';
                const enterButton = document.getElementById("continue-" + id);
                enterButton.focus();
                enterButton.addEventListener("keydown", function (event) {
                    enterButton.removeEventListener("keydown", arguments.callee);
                    if (event.key === "ArrowLeft") {
                        selectPrevious(event);
                    } else if (event.key === "ArrowRight") {
                        selecteNext(event);
                    }
                });
            } else {
                button.style.display = 'none';
            }
            const buttonContainers = document.getElementsByClassName('button-container');
            for (let i = 0; i < buttonContainers.length; i++) {
                if (buttonContainers[i].id !== `btns-${id}`) {
                    buttonContainers[i].style.display = 'none';
                }
            }

        }

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
            <div class="container">
                <div class="mdl-card mdl-shadow--8dp" title="<?= $hoverText ?>">
                    <div class="mdl-card__media white-bg fixed-height">
                        <button class="mdl-button fill-parent" onclick="toggleButtonDisplay(event, '<?= $idpId ?>')">
                            <img class="scale-to-parent" id="<?= $idpId ?>"
                                src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                                : $idp['logoURL'] ?>">
                        </button>
                    </div>
                </div>
                <div id="btns-<?= $idpId ?>" class="button-container" style="display: none;">
                    <button onclick="selectPrevious(event)" id="previous-<?= $idpId ?>">←</button>
                    <button class="continue" id="continue-<?= $idpId ?>" onclick="setSelectedIdp('<?= $idpId ?>')" >
                        ⏎Enter
                    </button>
                    <button onclick="selecteNext(event)" id="next-<?= $idpId ?>">→</button>
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
                <div class="mdl-card__media white-bg fixed-height" layout-children="row"
                     child-spacing="center">
                    <img class="scale-to-parent" id="<?= $idpId ?>"
                         src="<?= empty($idp['logoURL']) ? 'default-logo.png'
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
<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .button-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .mdl-card {
        border-radius: 8px;"
    }
    .continue {
        background-color:hsla(217, 94%, 53%, 1);
        color: #fff;
    }
</style>
</html>
