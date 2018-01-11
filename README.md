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
'theme.color-scheme' => ['indigo-purple'|'blue_grey-teal'|'red-teal'|'orange-light_blue'|'brown-orange'|'teal-blue']
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
7. Login as an "about to expire" user: `username=`**near_future** `password=`**a**
8. Click **Later**
9. Click **Logout**

#### Expired page
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp2**
7. Login as an "expired" user: `username=`**already_past** `password=`**a**

### Multi-factor authentication (MFA) functionality
#### Nag about missing MFA setup
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as an "unprotected" user: `username=`**nag_for_mfa** `password=`**a**
8. The "learn more" link should be visible if configured via env var `MFA_LEARN_MORE_URL`.

#### Force MFA setup
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as an "unsafe" user: `username=`**must_set_up_mfa** `password=`**a**
8. The "learn more" link should be visible if configured via env var `MFA_LEARN_MORE_URL`.

#### Backup code
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "backup code" user: `username=`**has_backupcode** `password=`**a**
8. Enter one of the following codes to verify (`94923279, 82743523, 77802769, 01970541, 37771076`)
9. Click **Logout**


#### TOTP code
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "totp" user: `username=`**has_totp** `password=`**a**
8. Set up an app using this secret, `GFDHSMZ6EVBFGRB4` **OR** `QR Code (paste in browser) data:image/png;base64,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`
9. Enter code from app to verify
10. Click **Logout**

#### Key (U2F)
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "u2f" user: `username=`**has_u2f** `password=`**a**
8. Insert key and press
9. Click **Logout**

#### Multiple options
1. Goto [http://ssp-hub.local](http://ssp-hub.local)
2. Login as hub administrator: `username=`**admin** `password=`**abc123**
3. Click **Authentication** tab
4. Click **Test configured authentication sources**
5. Click **hub-discovery**
6. Click **idp4**
7. Login as a "multiple option" user: `username=`**has_all** `password=`**a**
8. Click **MORE OPTIONS**

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
