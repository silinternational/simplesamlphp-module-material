<?php

use Sil\SilAuth\config\ConfigManager;

$config = [
    'admin' => [
        'core:AdminPassword',
    ],
    'silauth' => ConfigManager::getSspConfig(),
    'example-userpass' => [
        'exampleauth:UserPass',
        'nag_for_mfa:a' => [
            'eduPersonPrincipalName' => ['NAG_FOR_MFA@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['2b2d424e-8cb0-49c7-8c0b-7f660340f5fa'],
            'sn' => ['Mfas'],
            'givenName' => ['No'],
            'mail' => ['nag_for_mfa@example.com'],
            'employeeNumber' => ['11111'],
            'cn' => ['NAG_FOR_MFA'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'must_set_up_mfa:a' => [
            'eduPersonPrincipalName' => ['MUST_SET_UP_MFA@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['ef960c92-09fc-44f4-aadf-2d3aea6e0dbd'],
            'sn' => ['Have'],
            'givenName' => ['Must'],
            'mail' => ['must_set_up_mfa@example.com'],
            'employeeNumber' => ['22222'],
            'cn' => ['MUST_SET_UP_MFA'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'has_backupcode:a' => [
            'eduPersonPrincipalName' => ['HAS_BACKUPCODE@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['ef960c92-09fc-44f4-aadf-2d3aea6e0dbd'],
            'sn' => ['BackupCode'],
            'givenName' => ['Has'],
            'mail' => ['has_backupcode@example.com'],
            'employeeNumber' => ['33333'],
            'cn' => ['HAS_BACKUPCODE'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'has_totp:a' => [
            'eduPersonPrincipalName' => ['HAS_TOTP@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['7bab90d3-9f54-4187-804d-7f6400021789'],
            'sn' => ['TOTP'],
            'givenName' => ['Has'],
            'mail' => ['has_totp@example.com'],
            'employeeNumber' => ['44444'],
            'cn' => ['HAS_TOTP'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'has_u2f:a' => [
            'eduPersonPrincipalName' => ['HAS_U2F@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['6b614606-bbe8-4793-b0db-ca862295c661'],
            'sn' => ['U2F'],
            'givenName' => ['Has'],
            'mail' => ['has_u2f@example.com'],
            'employeeNumber' => ['55555'],
            'cn' => ['HAS_U2F'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'has_webauthn:a' => [
            'eduPersonPrincipalName' => ['HAS_WEBAUTHN@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['c818d44a-a322-45f4-a1d0-6afc3c2a54e9'],
            'sn' => ['Webauthn'],
            'givenName' => ['Has'],
            'mail' => ['has_webauthn@example.com'],
            'employeeNumber' => ['66666'],
            'cn' => ['HAS_WEBAUTHN'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'has_all_legacy:a' => [
            'eduPersonPrincipalName' => ['HAS_ALL_LEGACY@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['7c695eac-dbca-45d0-b3dc-2df2e1d2294c'],
            'sn' => ['All'],
            'givenName' => ['Has'],
            'mail' => ['has_all_legacy@example.com'],
            'employeeNumber' => ['77777'],
            'cn' => ['HAS_ALL_LEGACY'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'has_all:a' => [
            'eduPersonPrincipalName' => ['HAS_ALL@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['7c695eac-dbca-45d0-b3dc-2df2e1d2294c'],
            'sn' => ['All'],
            'givenName' => ['Has'],
            'mail' => ['has_all@example.com'],
            'employeeNumber' => ['77778'],
            'cn' => ['HAS_ALL'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'needs_review:a' => [
            'eduPersonPrincipalName' => ['NEEDS_REVIEW@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['7c695eac-dbca-45d0-b3dc-123jkhf23bql'],
            'sn' => ['Needed'],
            'givenName' => ['Review'],
            'mail' => ['needs_review@example.com'],
            'employeeNumber' => ['88888'],
            'cn' => ['NEEDS_REVIEW'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
        'nag_for_method:a' => [
            'eduPersonPrincipalName' => ['NAG_FOR_METHOD@ssp-hub-idp4.local'],
            'eduPersonTargetID' => ['7c695eac-dbca-45d0-b3dc-123jkhf23bbq'],
            'sn' => ['For_Method'],
            'givenName' => ['Nag'],
            'mail' => ['nag_for_method@example.com'],
            'employeeNumber' => ['99999'],
            'cn' => ['NAG_FOR_METHOD'],
            'schacExpiryDate' => [
                gmdate('YmdHis\Z', strtotime('+6 months')), // Distant future
            ],
        ],
    ],
];
