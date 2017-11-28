<?php
$config = [
    'example-userpass' => [
        'exampleauth:UserPass',
        'distant_future:a' => [
            'eduPersonPrincipalName' => ['DISTANT_FUTURE@ssp-hub-idp2.local'],
            'eduPersonTargetID' => ['11111111-1111-1111-1111-111111111111'],
            'sn' => ['Future'],
            'givenName' => ['Distant'],
            'mail' => ['distant_future@example.com'],
            'employeeNumber' => ['11111'],
            'cn' => ['DISTANT_FUTURE'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'near_future:a' => [
            'eduPersonPrincipalName' => ['NEAR_FUTURE@ssp-hub-idp2.local'],
            'eduPersonTargetID' => ['22222222-2222-2222-2222-222222222222'],
            'sn' => ['Future'],
            'givenName' => ['Near'],
            'mail' => ['near_future@example.com'],
            'employeeNumber' => ['22222'],
            'cn' => ['NEAR_FUTURE'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+1 day')), // Very soon
            ],
        ],
        'already_past:a' => [
            'eduPersonPrincipalName' => ['ALREADY_PAST@ssp-hub-idp2.local'],
            'eduPersonTargetID' => ['33333333-3333-3333-3333-333333333333'],
            'sn' => ['Past'],
            'givenName' => ['Already'],
            'mail' => ['already_past@example.com'],
            'employeeNumber' => ['33333'],
            'cn' => ['ALREADY_PAST'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('-1 day')), // In the past
            ],
        ],
    ],
];
