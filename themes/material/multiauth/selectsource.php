<?php
use Sil\SspUtils\AuthSourcesUtils;

$reducedSources = AuthSourcesUtils::getSourcesWithLogoUrls($this->data['sources'], $_GET['AuthState']);
$this->data['sources'] = $reducedSources;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login account</title>

    <?php include __DIR__ . '/../common-head-elements.php' ?>
</head>

<body>
<div class="mdl-layout mdl-layout--fixed-header fill-viewport">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">
                Choose an account
            </span>
        </div>
    </header>

    <main class="mdl-layout__content">
        <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>"
              layout-children="row" child-spacing="space-around">
            <input type="hidden" name="AuthState" 
                   value="<?= htmlspecialchars($this->data['authstate']) ?>" />

            <?php
            foreach ($this->data['sources'] as $source) {
                $name = $source['source'];
                $encodedName = 'src-' . base64_encode($name);
            ?>
            <div class="mdl-card mdl-shadow--8dp margin">
                <div class="mdl-card__media white-bg fixed-height">
                    <button class="mdl-button fill-parent no-padding" 
                            name="<?= $encodedName ?>"
                            value="<?= $name ?>" >
                        
                        <img src="<?= isset($source['logoURL']) ? 
                                      $source['logoURL']        : 
                                      '/module.php/material/default-logo.png' ?>">
                    </button>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button class="mdl-button mdl-button--colored fill-parent"
                            name="<?= $encodedName ?>"
                            value="<?= $name ?>">
                        <!-- div added because of https://github.com/philipwalton/flexbugs#9-some-html-elements-cant-be-flex-containers 
                             TODO: move properties to button and remove div if 
                                   these bugs are resolved. -->
                        <div layout-children="row" child-spacing="space-between">
                            <span>Login with <?= $name ?></span>

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
                    Coming soon...
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
