<?php
use Sil\PhpEnv\Env;
use Sil\Psr3Adapters\Psr3SamlLogger;

$metadata['http://ssp-idp2.local:8086'] = [
	'host' => '__DEFAULT__',
	'privatekey' => 'ssp-idp2.pem',
	'auth' => 'example-userpass',
    'authproc' => [
        10 => [
            'class' => 'expirychecker:ExpiryDate',
            'accountNameAttr' => 'cn',
            'expiryDateAttr' => 'schacExpiryDate',
            'passwordChangeUrl' => Env::get('PASSWORD_CHANGE_URL'),
            'warnDaysBefore' => 14,
            'dateFormat' => 'Y-m-d',
            'loggerClass' => Psr3SamlLogger::class,
        ]
    ]
];
