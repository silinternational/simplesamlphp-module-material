<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:selectidp:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script>
        function selectPrevious(event) {
            event.preventDefault();
            const ancestor = event.target.parentNode.parentNode.parentNode;
            const sibling = ancestor.previousElementSibling;
            const button = sibling.getElementsByClassName("mdl-button")[0];
            if (button) {
                button.focus()
                const id = event.target.id.split("-")[1];
                const enterButton = document.getElementById("continue-" + id);
                enterButton.removeEventListener("keydown", onKeyDown);
            }
        }

        function selecteNext (event) {
            event.preventDefault();
            const ancestor = event.target.parentNode.parentNode.parentNode;
            const sibling = ancestor.nextElementSibling;
            const button = sibling.getElementsByClassName("mdl-button")[0];
            if (button) {
                button.focus()
                const id = event.target.id.split("-")[1];
                const enterButton = document.getElementById("continue-" + id);
                enterButton.removeEventListener("keydown", onKeyDown);
            }
        }

        function onKeyDown (event) {
            if (event.key === "ArrowLeft") {
                selectPrevious(event)
            } else if (event.key === "ArrowRight") {
                selecteNext(event)
            } else if (event.key === "Tab") {
                selecteNext(event)
            }
        }
        
        function toggleButtonDisplay(event, id) {
            event.preventDefault();
            const button = document.getElementById(`btns-${id}`);
            if (button.style.display === 'none') {
                button.style.display = 'flex';
                const enterButton = document.getElementById("continue-" + id);
                enterButton.focus();
                enterButton.addEventListener("keydown", onKeyDown);
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
            const idpInput = document.createElement('input');

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
    <header class="header">
        <span class="title">
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
            <div class="cardContainer">
                <div class="mdl-card mdl-shadow--8dp" title="<?= $hoverText ?>">
                    <div class="mdl-card__media white-bg fixed-height">
                        <button class="mdl-button fill-parent" onclick="setSelectedIdp('<?= $idpId ?>')" 
                                                    onfocus="toggleButtonDisplay(event, '<?= $name ?>')">
                            <img class="scale-to-parent" id="<?= $name ?>"
                                src="<?= empty($idp['logoURL']) ? 'default-logo.png'
                                                                : $idp['logoURL'] ?>">
                        </button>
                    </div>
                </div>
                <div id="btns-<?= $name ?>" class="button-container" style="display: none;">
                <label class="container">
                    <button onclick="selectPrevious(event)" id="previous-<?= $name ?>">←</button>
                    Previous
                </label>
                <label class="container">
                    <button class="continue" id="continue-<?= $name ?>" onclick="setSelectedIdp('<?= $idpId ?>')" >
                        ⏎ Enter
                    </button>
                    to continue
                </label>
                <label class="container">
                    <button onclick="selecteNext(event)" id="next-<?= $name ?>">→</button>
                    Next
                </label>
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
    .cardContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 330px;
        width: -webkit-fill-available;
    }
    .button-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: -webkit-fill-available;
        max-width: 80%;
    }    
    .header {
        margin: 1.5rem;
    }
    .title {
        font-size: 23px;
        line-height: 36px;
    }
    .mdl-card {
        border-radius: 8px;
        width: 100%;
    }
    .continue {
        background-color:hsla(217, 94%, 53%, 1);
        color: #fff;
    }
</style>
</html>
