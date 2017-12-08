<?php
$mfaOptions = $this->data['mfaOptions'];
$currentMfaId = filter_input(INPUT_GET, 'mfaId');

function excludeSelf($others, $selfId) {
    return array_filter($others, function($option) use ($selfId) {
        return $option['id'] != $selfId;
    });
}

$otherOptions = excludeSelf($mfaOptions, $currentMfaId);
if (count($otherOptions) > 0) {
?>
<div layout-children="column" child-spacing="center">
    <!-- used type=button to avoid form submission on click since this is just used to display the ul -->
    <button id="others" type="button" class="mdl-button mdl-js-button">
        <span class="mdl-typography--caption">
            <?= $this->t('{material:mfa:use_others}') ?>
        </span>
    </button>
    <ul class="mdl-menu mdl-js-menu mdl-menu--top-left" data-mdl-for="others">
        <?php
        foreach ($otherOptions as $option) {
            $type = $option['type'];

            //TODO: is there an svg of the u2f icon?
            $image = 'mfa-' . $type . ($type === 'u2f' ? '.png' : '.svg');
            $altText = $this->t('{material:mfa:' . $type . '_icon}');
        ?>
        <li class="mdl-menu__item" onclick="location.href += '&mfaId=<?= $option['id'] ?>'">
            <span class="mdl-list__item-primary-content">
                <img class="mdl-list__item-icon" src="<?= $image ?>" alt="<?= $altText ?>">

                <?= $this->t('{material:mfa:use_' . $type . '}') ?>
            </span>
        </li>
        <?php
        }
        ?>
    </ul>
</div>
<?php
}
?>
