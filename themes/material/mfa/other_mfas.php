<!-- used type=button to avoid form submission on click -->
<button id="others" type="button" class="mdl-button mdl-js-button">
    <span class="mdl-typography--caption">
        <?= $this->t('{material:mfa:use_others}') ?>
    </span>
</button>
<ul class="mdl-menu mdl-js-menu mdl-menu--top-left" data-mdl-for="others">
    <?php
    $mfaOptions = $this->data['mfaOptions'];
    $currentMfaId = $this->data['formData']['mfaId'];

    function excludeSelf($others, $selfId) {
        return array_filter($others, function($option) use ($selfId) {
            return $option['id'] != $selfId;
        });
    }

    foreach (excludeSelf($mfaOptions, $currentMfaId) as $otherOption) {
    ?>
    <li class="mdl-menu__item"
        onclick="location.href += '&mfaId=<?= $otherOption['id'] ?>'">
        <span class="mdl-typography--caption">
            <?= $this->t('{material:mfa:use_'.$otherOption['type'].'}') ?>
        </span>
    </li>
    <?php
    }
    ?>
</ul>
