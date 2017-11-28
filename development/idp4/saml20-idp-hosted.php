<?php
use Sil\PhpEnv\Env;
use Sil\Psr3Adapters\Psr3SamlLogger;

$metadata['http://ssp-idp4.local:8088'] = [
    'host' => '__DEFAULT__',
    'privatekey' => 'ssp-idp4.pem',
    'auth' => 'silauth',
    'authproc' => [
        10 => [
            'class' => 'mfa:Mfa',
            'employeeIdAttr' => 'employeeNumber',
            'idBrokerAccessToken' => Env::get('ID_BROKER_ACCESS_TOKEN'),
            'idBrokerAssertValidIp' => Env::get('ID_BROKER_ASSERT_VALID_IP'),
            'idBrokerBaseUri' => Env::get('ID_BROKER_BASE_URI'),
            'idBrokerTrustedIpRanges' => Env::get('ID_BROKER_TRUSTED_IP_RANGES'),
            'mfaSetupUrl' => Env::get('MFA_SETUP_URL'),
            'mfaLearnMoreUrl' => Env::get('MFA_LEARN_MORE_URL'),
            'loggerClass' => Psr3SamlLogger::class,
        ],
    ]
];
