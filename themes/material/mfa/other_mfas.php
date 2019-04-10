<?php
$mfaOptions = $this->data['mfaOptions'];
$currentMfaId = filter_input(INPUT_GET, 'mfaId');

function excludeSelf($others, $selfId) {
    return array_filter($others, function($option) use ($selfId) {
        return $option['id'] != $selfId;
    });
}

$otherOptions = excludeSelf($mfaOptions, $currentMfaId);

if (! empty($this->data['managerEmail'])) {
    $otherOptions[] = [
        'type' => 'manager',
        'callback' => '/module.php/mfa/send-manager-mfa.php?StateId='.htmlentities($this->data['stateId'])
    ];
}

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

            $callback = $option['callback'] ?? '/module.php/mfa/prompt-for-mfa.php?StateId='.htmlentities($this->data['stateId']).'&mfaId='.htmlentities($option['id']);

            $image = 'mfa-' . $type . '.svg';
            $altText = $this->t('{material:mfa:' . $type . '_icon}');
        ?>
        <li class="mdl-menu__item" onclick="location.href = '<?= $callback ?>'">
            <span class="mdl-list__item-primary-content">
                <img class="mdl-list__item-icon" src="<?= $image ?>" alt="<?= $altText ?>">

                <?php
                $label = empty($option['id']) ? 'help' : $type;
                ?>
                <?= $this->t('{material:mfa:use_' . $label . '}') ?>
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
