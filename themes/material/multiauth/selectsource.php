<?php
use Sil\SspUtils\AuthSourcesUtils;

$reducedSources = AuthSourcesUtils::getSourcesWithLogoUrls($this->data['sources'], $_GET['AuthState']);
$this->data['sources'] = $reducedSources;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login account</title>

    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/module.php/theme-material/material.indigo-pink.min.css">
    <link rel="stylesheet" href="/module.php/theme-material/selectsource.css">
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
        <form action="<?= htmlentities($_SERVER['PHP_SELF']); ?>"
              layout-children="row" child-spacing="space-around">
            <input type="hidden" name="AuthState" 
                   value="<?= htmlspecialchars($this->data['authstate']); ?>"/>

            <?php
            foreach ($this->data['sources'] as $source) {
                $name = $source['source'];
                $encodedName = 'src-' . base64_encode($name);
            ?>
            <div class="mdl-card mdl-shadow--4dp margin">
                <div class="mdl-card__media white-bg fixed-height">
                    <button class="mdl-button fill-parent no-padding" 
                            name="<?= $encodedName; ?>"
                            value="<?= $name; ?>" >
                        
                        <img src="<?= isset($source['logoURL']) ? 
                                      $source['logoURL']        : 
                                      '/module.php/theme-material/default-logo.png'; ?>">
                    </button>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button class="mdl-button mdl-button--colored fill-parent"
                            name="<?= $encodedName; ?>"
                            value="<?= $name; ?>">
                        <!-- div added because of https://github.com/philipwalton/flexbugs#9-some-html-elements-cant-be-flex-containers 
                             TODO: move properties to button and remove div if 
                                   these bugs are resolved. -->
                        <div layout-children="row" child-spacing="space-between">
                            <span>Login with <?= $name; ?></span>

                            <i class="material-icons">exit_to_app</i>
                        </div>
                    </button>
                </div>
            </div>
            <?php
            }
            ?>
        </form>
    </main>

    <footer class="mdl-mini-footer">
        Unauthorized use of this site is prohibited and may be subjected to civil and criminal prosecution.
    </footer>
</div>
</body>
</html>
