<?php

use Sil\SilAuth\config\ConfigManager;

$config = [
    'admin' => [
        'core:AdminPassword',
    ],
    'silauth' => ConfigManager::getSspConfig(),
];
