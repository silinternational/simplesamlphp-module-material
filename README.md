Material Design theme for use with SimpleSAMLphp 

## Installation

```
composer.phar require silinternational/simplesamlphp-module-material:dev-master
```

## Configuration

Update `/simplesamlphp/config/config.php`:

```
'theme.use' => 'material:material'
```

_[ssp-base](https://github.com/silinternational/ssp-base) provides a convenience by loading this config with whatever is in the environment variable `THEME_USE`._

### Google reCAPTCHA
If a site key has been provided in `$this->data['recaptcha.siteKey']`, the 
username/password page may require the user prove his/her humanity.

### Branding
Update `/simplesamlphp/config/config.php`:

```
'theme.color-scheme' => ['indigo-purple'|'blue_grey-teal'|'red-teal'|'orange-light_blue']
```

The login page looks for `/simplesamlphp/www/logo.png` which is **NOT** provided by default.

### Analytics
Update `/simplesamlphp/config/config.php`:

```
'analytics.trackingId' => 'UA-some-unique-id-for-your-site'
```

_[ssp-base](https://github.com/silinternational/ssp-base) provides a convenience by loading this config with whatever is in the environment variable `ANALYTICS_ID`._

### Announcements
Update `/simplesamlphp/config/config.php`:

```
'announcement' => 'Some <strong>important</strong> announcement'
```

_[ssp-base](https://github.com/silinternational/ssp-base) provides a convenience by loading this config with whatever is returned by `/simplesamlphp/announcement/announcement.php`._

If configured, an alert will be shown to the user filled with the content of that announcement.  HTML is supported.

## Testing theme

[Make](https://www.gnu.org/software/make/), [Docker](https://www.docker.com/products/overview) and 
[Docker Compose](https://docs.docker.com/compose/install/) are required.

### Setup 

1. Setup `localhost` (or `192.168.62.54`, if using Vagrant) aliases for `ssp-hub.local`, `ssp-hub2.local`, `ssp-idp1.local`, `ssp-idp2.local`, `ssp-idp3.local` and `ssp-idp4.local`.  This is typically done in `/etc/hosts`.
2. Start test environment, i.e., `make` from the command line.

### Hub page
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**

### Error page
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Federation** tab
4. Click either **Show metadata** link

### Logout page
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **admin**
6. Click **Logout**

### Login page
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp1**
7. NOTE: login page should NOT have material design
8. Login as idp1 administrator: `username=`**admin** `password=`**a**
9. Click **Logout**
10. Goto [http://ssp-hub.local](http://ssp-hub.local)
11. Click **Authentication** tab
12. Click **Test configured authentication sources**
13. Click **hub-discovery**
14. Click **idp2**
15. NOTE: login page should have material design
16. Login as an idp2 user: `username=`**distant_future** `password=`**a**
17. Click **Logout**

### Forgot password functionality
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp2**
7. Forgot password link should be visible

### Expiry functionality
#### About to expire page
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp2**
7. Login as an "about to expire" user: `username=`**near_future** `password=`**b**
8. Click **Later**
9. Click **Logout**

#### Expired page
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp2**
7. Login as an "expired" user: `username=`**already_past** `password=`**c**

### Multi-factor authentication (MFA) functionality
#### Nag about missing MFA setup
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as an "unprotected" user: `username=`**no_mfa_needed** `password=`**a**
7. TODO: add remaining steps

#### Force MFA setup
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as an "unsafe" user: `username=`**must_set_up_mfa** `password=`**a**
7. TODO: add remaining steps

#### Backup code
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "backup code" user: `username=`**has_backupcode** `password=`**a**
7. TODO: add remaining steps

#### TOTP code
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "totp" user: `username=`**has_totp** `password=`**a**
7. TODO: add remaining steps

#### Key (U2F)
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "u2f" user: `username=`**has_u2f** `password=`**a**
7. TODO: add remaining steps

#### Multiple options
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "multiple option" user: `username=`**has_all** `password=`**a**
7. TODO: add remaining steps

### Announcements functionality
1. Goto [http://ssp-hub2.local:8081](http://ssp-hub2.local:8081)
2. The announcement should be displayed
3. Login as hub2 administrator: `username=`**admin** `password=`**abc123**
4. Click **Authentication** tab
5. Click **Test configured authentication sources**
6. Click **hub-discovery**
7. The announcement should be displayed
8. Click **idp3**
9. The announcement should be displayed

## i18n support
Translations are categorized by page in definition files located in the `dictionaries` directory.

Localization is affected by the configuration setting `language.available`.  Only language codes found in this property will be utilized.  
For example, if a translation is provided in Afrikaans for this module, the configuration must be adjusted to make 'af' an available
language.  If that's not done, the translation function will not utilize the translations even if provided.
