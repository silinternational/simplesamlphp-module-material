<?php
$config = [
    'admin' => [
        'core:AdminPassword',
    ],
    'hub-discovery' => [
        'saml:SP',
        'entityID' => 'ssp-hub2.local',
        'discoURL'  => 'http://ssp-hub2.local:8081/module.php/sildisco/disco.php',
    ],
];
