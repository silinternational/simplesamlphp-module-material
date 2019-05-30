<!DOCTYPE html>
<html>
<head>
    <title><?= $this->t('{material:review:title}') ?></title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>

    <script>
        function prettifyDates() {
            const relevantNodes = Array.from(document.querySelectorAll('span.mdl-list__item-text-body'))

            relevantNodes.filter(hasDate).map(replaceWithLocaleDate)
        }

        const hasDate = node => node.innerText.includes('Z')
        const replaceWithLocaleDate = node => {
            // assuming a string like this but could be in Spanish, French or Korean for example:  "last used: 2019-04-04T13:30:04Z"
            const matches = node.innerText.match(/(.*: )(.*)/)

            const label = matches[1]
            const date = new Date(matches[2])

            node.innerText = `${label} ${date.toLocaleDateString()} ${date.toLocaleTimeString()}`
        }
    </script>
</head>
<body class="gradient-bg" onload="prettifyDates()">
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                <?= $this->t('{material:review:header}') ?>
            </span>
        </div>
    </header>

    <main class="mdl-layout__content" layout-children="column">
        <form layout-children="column" method="post">
            <p>
                <h2 class="mdl-typography--headline">
                    <?= $this->t('{material:review:info}') ?>
                </h2>
            </p>
            
            <section layout-children="row-top" >
                <?php if (count($this->data['mfaOptions']) > 0): ?>
                <div class="mdl-card fixed-width mdl-shadow--8dp">
                    <div class="mdl-card__title center">
                        <h1 class="mdl-card__title-text">
                            <?= $this->t('{material:review:mfa_header}') ?>
                        </h1>
                    </div>

                    <div class="mdl-card__title" >
                        <ul class="mdl-card__subtitle-text mdl-list">
                            <?php foreach ($this->data['mfaOptions'] as $mfa): ?>
                            <li class="mdl-list__item mdl-list__item--three-line">
                                <span class="mdl-list__item-primary-content">
                                    <img class="mdl-list__item-icon" src="<?= 'mfa-' . $mfa['type'] . '.svg' ?>">
                                    
                                    <?= htmlentities($mfa['label']) ?> 
                                    
                                    <?php if ($mfa['type'] == 'backupcode'): ?>
                                    <?= $this->t('{material:review:remaining}', ['{count}' => (string) $mfa['data']['count']]) ?>
                                    <?php endif; ?>
                                    
                                    <span class="mdl-list__item-text-body">
                                        <?php if (empty($mfa['last_used_utc'])): ?>
                                        <?= $this->t('{material:review:used_never}') ?>
                                        <?php else: ?>
                                        <?= $this->t('{material:review:used}', ['{when}' => $mfa['last_used_utc']]) ?>
                                        <?php endif; ?>
                                    </span>
                                </span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (count($this->data['methodOptions']) > 0): ?>
                <!-- if there are two cards, remove the right margin so the buttons align with the edge of the card. -->
                <div class="mdl-card fixed-width mdl-shadow--8dp" style="<?= count($this->data['methodOptions']) == 2 ? 'margin-right: 0px' : '' ?>">
                    <div class="mdl-card__title center">
                        <h1 class="mdl-card__title-text">
                            <?= $this->t('{material:review:methods_header}') ?>
                        </h1>
                    </div>

                    <div class="mdl-card__title" >
                        <ul class="mdl-card__subtitle-text mdl-list">
                            <?php foreach ($this->data['methodOptions'] as $method): ?>
                            <li class="mdl-list__item mdl-list__item--two-line">
                                <span class="mdl-list__item-primary-content">
                                    <img class="mdl-list__item-icon" src="email.svg">

                                    <?= htmlentities($method['value']) ?> 
                                    
                                    <span class="mdl-list__item-sub-title">
                                        <?= $this->t('{material:review:'.($method['verified'] ? 'verified' : 'unverified').'}') ?>
                                    </span>
                                </span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </section>
            
            <section layout-children="row" child-spacing="end" class="fill-parent margin">
                <a href="<?= htmlentities($this->data['profileUrl']) ?>" target="_blank" onclick="document.querySelector('button').click()" 
                   class="mdl-button mdl-button--colored" layout-children="row">
                    <?= $this->t('{material:review:button_update}') ?> <i class="material-icons">launch</i>
                </a>

                <button name="continue" class="mdl-button mdl-button--raised mdl-button--colored">
                    <?= $this->t('{material:review:button_continue}') ?>
                </button>
            </section>
        </form>
    </main>

    <?php include __DIR__ . '/../common-footer.php' ?>
</div>
</body>
</html>
