<?php
return [
    'http://ssp-idp1.local:8085' => [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'http://ssp-idp1.local:8085',
        'name' => [
            'en' => 'IdP 1'
        ],
        'IDPNamespace' => 'IDP-1',
        'SingleSignOnService'  => 'http://ssp-idp1.local:8085/saml2/idp/SSOService.php',
        'SingleLogoutService'  => 'http://ssp-idp1.local:8085/saml2/idp/SingleLogoutService.php',
        'certData' => 'MIIDzzCCAregAwIBAgIJAPlZYTAQSIbHMA0GCSqGSIb3DQEBCwUAMH4xCzAJBgNVBAYTAlVTMQswCQYDVQQIDAJOQzEPMA0GA1UEBwwGV2F4aGF3MQwwCgYDVQQKDANTSUwxDTALBgNVBAsMBEdUSVMxDjAMBgNVBAMMBVN0ZXZlMSQwIgYJKoZIhvcNAQkBFhVzdGV2ZV9iYWd3ZWxsQHNpbC5vcmcwHhcNMTYxMDE3MTIzMTQ1WhcNMjYxMDE3MTIzMTQ1WjB+MQswCQYDVQQGEwJVUzELMAkGA1UECAwCTkMxDzANBgNVBAcMBldheGhhdzEMMAoGA1UECgwDU0lMMQ0wCwYDVQQLDARHVElTMQ4wDAYDVQQDDAVTdGV2ZTEkMCIGCSqGSIb3DQEJARYVc3RldmVfYmFnd2VsbEBzaWwub3JnMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArssOaeKbdOQFpN6bBolwSJ/6QFBXA73Sotg60anx9v6aYdUTmi+b7SVtvOmHDgsD5X8pN/6Z11QCZfTYg2nW3ZevGZsj8W/R6C8lRLHzWUr7e7DXKfj8GKZptHlUs68kn0ndNVt9r/+irJe9KBdZ+4kAihykomNdeZg06bvkklxVcvpkOfLTQzEqJAmISPPIeOXes6hXORdqLuRNTuIKarcZ9rstLnpgAs2TE4XDOrSuUg3XFnM05eDpFQpUb0RXWcD16mLCPWw+CPrGoCfoftD5ZGfll+W2wZ7d0kQ4TbCpNyxQH35q65RPVyVNPgSNSsFFkmdcqP9DsFqjJ8YC6wIDAQABo1AwTjAdBgNVHQ4EFgQUD6oyJKOPPhvLQpDCC3027QcuQwUwHwYDVR0jBBgwFoAUD6oyJKOPPhvLQpDCC3027QcuQwUwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEAA6tCLHJQGfXGdFerQ3J0wUu8YDSLb0WJqPtGdIuyeiywR5ooJf8G/jjYMPgZArepLQSSi6t8/cjEdkYWejGnjMG323drQ9M1sKMUhOJF4po9R3t7IyvGAL3fSqjXA8JXH5MuGuGtChWxaqhduA0dBJhFAtAXQ61IuIQF7vSFxhTwCvJnaWdWD49sG5OqjCfgIQdY/mw70e45rLnR/bpfoigL67sTJxy+Kx2ogbvMR6lITByOEQFMt7BYpMtXrwvKUM7k9NOo1jREmJacC8PTx//jRhCWwzUj1RsfIri24BuITrawwqMsYl8DZiiwMpjUf9m4NPaf4E7+QRpzo+MCcg==',
    ],
    'http://ssp-idp2.local:8086'=> [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'http://ssp-idp2.local:8086',
        'name' => [
            'en' => 'IdP 2'
        ],
        'IDPNamespace' => 'IDP-2',
        'SingleSignOnService'  => 'http://ssp-idp2.local:8086/saml2/idp/SSOService.php',
        'SingleLogoutService'  => 'http://ssp-idp2.local:8086/saml2/idp/SingleLogoutService.php',
        'certData' => 'MIIDzzCCAregAwIBAgIJAPlZYTAQSIbHMA0GCSqGSIb3DQEBCwUAMH4xCzAJBgNVBAYTAlVTMQswCQYDVQQIDAJOQzEPMA0GA1UEBwwGV2F4aGF3MQwwCgYDVQQKDANTSUwxDTALBgNVBAsMBEdUSVMxDjAMBgNVBAMMBVN0ZXZlMSQwIgYJKoZIhvcNAQkBFhVzdGV2ZV9iYWd3ZWxsQHNpbC5vcmcwHhcNMTYxMDE3MTIzMTQ1WhcNMjYxMDE3MTIzMTQ1WjB+MQswCQYDVQQGEwJVUzELMAkGA1UECAwCTkMxDzANBgNVBAcMBldheGhhdzEMMAoGA1UECgwDU0lMMQ0wCwYDVQQLDARHVElTMQ4wDAYDVQQDDAVTdGV2ZTEkMCIGCSqGSIb3DQEJARYVc3RldmVfYmFnd2VsbEBzaWwub3JnMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArssOaeKbdOQFpN6bBolwSJ/6QFBXA73Sotg60anx9v6aYdUTmi+b7SVtvOmHDgsD5X8pN/6Z11QCZfTYg2nW3ZevGZsj8W/R6C8lRLHzWUr7e7DXKfj8GKZptHlUs68kn0ndNVt9r/+irJe9KBdZ+4kAihykomNdeZg06bvkklxVcvpkOfLTQzEqJAmISPPIeOXes6hXORdqLuRNTuIKarcZ9rstLnpgAs2TE4XDOrSuUg3XFnM05eDpFQpUb0RXWcD16mLCPWw+CPrGoCfoftD5ZGfll+W2wZ7d0kQ4TbCpNyxQH35q65RPVyVNPgSNSsFFkmdcqP9DsFqjJ8YC6wIDAQABo1AwTjAdBgNVHQ4EFgQUD6oyJKOPPhvLQpDCC3027QcuQwUwHwYDVR0jBBgwFoAUD6oyJKOPPhvLQpDCC3027QcuQwUwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEAA6tCLHJQGfXGdFerQ3J0wUu8YDSLb0WJqPtGdIuyeiywR5ooJf8G/jjYMPgZArepLQSSi6t8/cjEdkYWejGnjMG323drQ9M1sKMUhOJF4po9R3t7IyvGAL3fSqjXA8JXH5MuGuGtChWxaqhduA0dBJhFAtAXQ61IuIQF7vSFxhTwCvJnaWdWD49sG5OqjCfgIQdY/mw70e45rLnR/bpfoigL67sTJxy+Kx2ogbvMR6lITByOEQFMt7BYpMtXrwvKUM7k9NOo1jREmJacC8PTx//jRhCWwzUj1RsfIri24BuITrawwqMsYl8DZiiwMpjUf9m4NPaf4E7+QRpzo+MCcg==',
    ],
    'http://ssp-idp4.local:8088'=> [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'http://ssp-idp4.local:8088',
        'name' => [
            'en' => 'IdP 4'
        ],
        'IDPNamespace' => 'IDP-4',
        'SingleSignOnService'  => 'http://ssp-idp4.local:8088/saml2/idp/SSOService.php',
        'SingleLogoutService'  => 'http://ssp-idp4.local:8088/saml2/idp/SingleLogoutService.php',
        'certData' => 'MIIDzzCCAregAwIBAgIJAPlZYTAQSIbHMA0GCSqGSIb3DQEBCwUAMH4xCzAJBgNVBAYTAlVTMQswCQYDVQQIDAJOQzEPMA0GA1UEBwwGV2F4aGF3MQwwCgYDVQQKDANTSUwxDTALBgNVBAsMBEdUSVMxDjAMBgNVBAMMBVN0ZXZlMSQwIgYJKoZIhvcNAQkBFhVzdGV2ZV9iYWd3ZWxsQHNpbC5vcmcwHhcNMTYxMDE3MTIzMTQ1WhcNMjYxMDE3MTIzMTQ1WjB+MQswCQYDVQQGEwJVUzELMAkGA1UECAwCTkMxDzANBgNVBAcMBldheGhhdzEMMAoGA1UECgwDU0lMMQ0wCwYDVQQLDARHVElTMQ4wDAYDVQQDDAVTdGV2ZTEkMCIGCSqGSIb3DQEJARYVc3RldmVfYmFnd2VsbEBzaWwub3JnMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArssOaeKbdOQFpN6bBolwSJ/6QFBXA73Sotg60anx9v6aYdUTmi+b7SVtvOmHDgsD5X8pN/6Z11QCZfTYg2nW3ZevGZsj8W/R6C8lRLHzWUr7e7DXKfj8GKZptHlUs68kn0ndNVt9r/+irJe9KBdZ+4kAihykomNdeZg06bvkklxVcvpkOfLTQzEqJAmISPPIeOXes6hXORdqLuRNTuIKarcZ9rstLnpgAs2TE4XDOrSuUg3XFnM05eDpFQpUb0RXWcD16mLCPWw+CPrGoCfoftD5ZGfll+W2wZ7d0kQ4TbCpNyxQH35q65RPVyVNPgSNSsFFkmdcqP9DsFqjJ8YC6wIDAQABo1AwTjAdBgNVHQ4EFgQUD6oyJKOPPhvLQpDCC3027QcuQwUwHwYDVR0jBBgwFoAUD6oyJKOPPhvLQpDCC3027QcuQwUwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEAA6tCLHJQGfXGdFerQ3J0wUu8YDSLb0WJqPtGdIuyeiywR5ooJf8G/jjYMPgZArepLQSSi6t8/cjEdkYWejGnjMG323drQ9M1sKMUhOJF4po9R3t7IyvGAL3fSqjXA8JXH5MuGuGtChWxaqhduA0dBJhFAtAXQ61IuIQF7vSFxhTwCvJnaWdWD49sG5OqjCfgIQdY/mw70e45rLnR/bpfoigL67sTJxy+Kx2ogbvMR6lITByOEQFMt7BYpMtXrwvKUM7k9NOo1jREmJacC8PTx//jRhCWwzUj1RsfIri24BuITrawwqMsYl8DZiiwMpjUf9m4NPaf4E7+QRpzo+MCcg==',
    ],
    'jaars-idp'=> [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'jaars-idp',
        'name' => [
            'en' => 'jaars'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/jaars-logo.png'
    ],
    'sil-idp'=> [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'sil-idp',
        'name' => [
            'en' => 'sil'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/sil-logo.png'
    ],
    'usa-idp'=> [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'usa-idp',
        'name' => [
            'en' => 'usa'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/usa-logo.png'
    ],
    'wga-idp'=> [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'wga-idp',
        'name' => [
            'en' => 'wga'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/wga-logo.png'
    ],
    'collaborate-idp'=> [
        'enabled' => true,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'collaborate-idp',
        'name' => [
            'en' => 'collaborate'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/collaborate-logo.png'
    ],
    'mock-jaars-idp'=> [
        'enabled' => false,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'mock-jaars-idp',
        'name' => [
            'en' => 'jaars'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/jaars-logo.png'
    ],
    'mock-sil-idp'=> [
        'enabled' => false,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'mock-sil-idp',
        'name' => [
            'en' => 'sil'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/sil-logo.png'
    ],
    'mock-usa-idp'=> [
        'enabled' => false,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'mock-usa-idp',
        'name' => [
            'en' => 'usa'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/usa-logo.png'
    ],
    'mock-wga-idp'=> [
        'enabled' => false,
        'metadata-set' => 'saml20-idp-remote',
        'entityid' => 'mock-wga-idp',
        'name' => [
            'en' => 'wga'
        ],
        'logoURL' => 'https://static.gtis.guru/idp-logo/wga-logo.png'
    ],
];
