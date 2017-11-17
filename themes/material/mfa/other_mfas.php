<!-- used type=button to avoid form submission on click -->
<button id="others" type="button" class="mdl-button mdl-js-button">
    <span class="mdl-typography--caption">
        <?= $this->t('{material:mfa:use_others}') ?>
    </span>
</button>
<ul class="mdl-menu mdl-js-menu mdl-menu--top-left" data-mdl-for="others">
    <?php
    $mfaOptions = $this->data['mfaOptions'];
    $currentMfaId = filter_input(INPUT_GET, 'mfaId');

    function excludeSelf($others, $selfId) {
        return array_filter($others, function($option) use ($selfId) {
            return $option['id'] != $selfId;
        });
    }

    foreach (excludeSelf($mfaOptions, $currentMfaId) as $otherOption) {
        $type = $otherOption['type'];

        //TODO: is there an svg of the u2f icon?
        $image = 'mfa-'.$type.($type === 'u2f' ? '.png' : '.svg');
    ?>
    <li class="mdl-menu__item" onclick="location.href += '&mfaId=<?= $otherOption['id'] ?>'">
        <span class="mdl-list__item-primary-content">
            <img class="mdl-list__item-icon" src="<?= $image ?>"
                 alt="<?= $this->t('{material:mfa:'.$type.'_icon}') ?>">

            <?= $this->t('{material:mfa:use_'.$type.'}') ?>
        </span>
    </li>
    <?php
    }
    ?>
</ul>
