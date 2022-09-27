<?php

use Sil\SilAuth\config\ConfigManager;

$config = [
    'admin' => [
        'core:AdminPassword',
    ],
    'silauth' => ConfigManager::getSspConfig(),
    // Test user credentials are in the database migration m991231_235959_insert_mfa_test_users.php
];
