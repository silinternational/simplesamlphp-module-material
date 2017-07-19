<?php
use Sil\PhpEnv\Env;
use Sil\Psr3Adapters\Psr3SamlLogger;

$metadata['http://ssp-hub-idp2.local:8086'] = [
	'host' => '__DEFAULT__',
	'privatekey' => 'ssp-hub-idp2.pem',
	'auth' => 'example-userpass',
    'authproc' => [
        10 => [
            'class' => 'expirychecker:ExpiryDate',
            'accountNameAttr' => 'cn',
            'expiryDateAttr' => 'schacExpiryDate',
            'changePwdUrl' => Env::get('CHANGE_PWD_URL'),
            'warnDaysBefore' => 14,
            'dateFormat' => 'Y-m-d',
            'loggerClass' => Psr3SamlLogger::class,
        ]
    ]
];
