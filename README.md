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

Update `/simplesamlphp/announcement/announcement.php`:

```
 return 'Some <strong>important</strong> announcement';
```

_[ssp-utilities](https://github.com/silinternational/ssp-utilities) provides whatever is returned by `/simplesamlphp/announcement/announcement.php`._

If provided, an alert will be shown to the user filled with the content of that announcement. HTML is supported.

## Testing theme

[Make](https://www.gnu.org/software/make/), [Docker](https://www.docker.com/products/overview) and
[Docker Compose](https://docs.docker.com/compose/install/) are required.

### Setup

1.  Setup `localhost` (or `192.168.62.54`, if using Vagrant) aliases for `ssp-hub1.local`, `ssp-hub2.local`, `ssp-idp1.local`, `ssp-idp2.local`, `ssp-idp3.local`, `ssp-idp4.local`, `ssp-sp1.local` and `ssp-sp2.local`. This is typically done in `/etc/hosts`.  _Example line:  `0.0.0.0  ssp-hub1.local ssp-idp1.local ssp-idp2.local ssp-idp4.local ssp-hub2.local ssp-idp3.local ssp-sp1.local ssp-sp2.local`_
1.  Start test environment, i.e., `make` from the command line.

### Hub page

1.  Goto [Hub 1](http://ssp-hub1.local/module.php/core/authenticate.php?as=hub-discovery)

### Error page

1.  Goto [Hub 1](http://ssp-hub1.local)
1.  Click **Federation** tab
1.  Click either **Show metadata** link
1.  Login as hub administrator: `username=`**admin** `password=`**abc123**

### Logout page

1.  Goto [Hub 1](http://ssp-hub1.local)
1.  Click **Authentication** tab
1.  Click **Test configured authentication sources**
1.  Click **admin**
1.  Login as hub administrator: `username=`**admin** `password=`**abc123**
1.  Click **Logout**

### Login page

#### Without theme in place

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp1** (first one)
1.  login page should **NOT** have material design

#### With theme in place

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp2** (second one)
1.  login page **SHOULD** have material design

### Forgot password functionality

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp2** (second one)
1.  Forgot password link should be visible

### Expiry functionality

#### About to expire page

_Note:  This nag only works once since choosing later will simply set the nag date into the future a little._

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp2** (second one)
1.  Login as an "about to expire" user: `username=`**near_future** `password=`**a**
1.  Click **Later**
1.  Click **Logout**

#### Expired page

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp2** (second one)
1.  Login as an "expired" user: `username=`**already_past** `password=`**a**

### Multi-factor authentication (MFA) functionality

#### Nag about missing MFA setup

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as an "unprotected" user: `username=`**nag_for_mfa** `password=`**a**
1.  The "learn more" link should be visible
1.  Click **Enable**
1.  Click your browser's back button
1.  Click **Remind me later**
1.  Click **Logout**

#### Nag about missing password recovery methods

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as a user without any methods: `username=`**nag_for_method** `password=`**a**
1.  Enter one of the following codes to verify (`94923279, 82743523, 77802769, 01970541, 37771076`)
1.  The "learn more" link should be visible
1.  Click **Add**
1.  Click your browser's back button
1.  Click **Remind me later**
1.  Click **Logout**

#### Force MFA setup

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as an "unsafe" user: `username=`**must_set_up_mfa** `password=`**a**
1.  The "learn more" link should be visible

#### Backup code

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as a "backup code" user: `username=`**has_backupcode** `password=`**a**
1.  Enter one of the following codes to verify (`94923279, 82743523, 77802769, 01970541, 37771076`)
1.  Click **Logout**
1.  In order to see the "running low on codes" page, simply log back in and use another code.
1.  In order to see the "out of codes" page, simply log back in and out repeatedly until there are no more codes.

#### TOTP code

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as a "totp" user: `username=`**has_totp** `password=`**a**
1.  Set up an app using this secret, `JVRXKYTMPBEVKXLS`
1.  Enter code from app to verify
1.  Click **Logout**

#### Key (U2F)

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as a "u2f" user: `username=`**has_u2f** `password=`**a**
1.  Insert key and press
1.  Click **Logout**

#### Multiple options

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as a "multiple option" user: `username=`**has_all** `password=`**a**
1.  Click **MORE OPTIONS**

#### Manager rescue

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as a "multiple option" user: `username=`**has_all** `password=`**a**
1.  Click **MORE OPTIONS**
1.  Click the help option
1.  Choose **Send**

_NOTE: At this time, the correct code is not known and can't be tested locally (it's only available in an email to the manager)_

### Announcements functionality

1.  Goto [SP 2](http://ssp-sp2.local:8083/module.php/core/authenticate.php?as=hub-discovery)
1.  The announcement should be displayed on the hub
1.  Click **idp3** (first one)
1.  The announcement should be displayed at the login screen

### SP name functionality

1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  The sp name should appear in the banner

### Profile review functionality
1.  Goto [SP 1](http://ssp-sp1.local:8082/module.php/core/authenticate.php?as=hub-discovery)
1.  Click **idp4** (third one)
1.  Login as a "Review needed" user: `username=`**needs_review** `password=`**a**
1.  Enter one of the following printable codes to verify (`94923279, 82743523, 77802769, 01970541, 37771076`)
1.  Click the button to update the profile
1.  Click the button to continue
1.  Click **Logout**


## i18n support

Translations are categorized by page in definition files located in the `dictionaries` directory.

Localization is affected by the configuration setting `language.available`. Only language codes found in this property will be utilized.  
For example, if a translation is provided in Afrikaans for this module, the configuration must be adjusted to make 'af' an available
language. If that's not done, the translation function will not utilize the translations even if provided.
