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

### Google reCAPTCHA
If a site key has been provided in `$this->data['recaptcha.siteKey']`, the 
username/password page may require the user prove his/her humanity.

### Branding
Update `/simplesamlphp/config/config.php`:

```
'theme.color-scheme' => ['indigo-purple'|'blue_grey-teal'|'red-teal'|'orange-light_blue']
```

The login page will get its images from `/simplesamlphp/www/favicon.ico` and 
`/simplesamlphp/www/logo.png` which are **NOT** provided by default.

### Analytics
Update `/simplesamlphp/config/config.php`:

```
'analytics.trackingId' => 'UA-some-unique-id-for-your-site'
```

### Announcements
If something is found in `$this->data['announcement']` an alert will be shown to the user filled with the 
content of that announcement.  HTML is supported.

## Testing theme

[Make](https://www.gnu.org/software/make/), [Docker](https://www.docker.com/products/overview) and 
[Docker Compose](https://docs.docker.com/compose/install/) are required.

### Setup 

1. Setup `localhost` aliases for `ssp-hub.local`, `ssp-hub-idp1.local`, and `ssp-hub-idp2.local`.  This is typically done in `/etc/hosts`.
2. Start test environment, e.g., `make` from the command line.
3. Goto [http://ssp-hub.local](http://ssp-hub.local).
4. Login as hub administrator, e.g., username=admin & password=abc123

### Hub
1. Click **Authentication** tab
2. Click **Test configured authentication sources**
3. Click **hub-discovery**

### Error
1. Click **Federation** tab
2. Click either **Show metadata** link

### Logout
1. Click **Authentication** tab
2. Click **Test configured authentication sources**
3. Click **admin**
4. Click **Logout**

### Login
1. Click **Authentication** tab
2. Click **Test configured authentication sources**
3. Click **hub-discovery**
4. Click **Login with idp1** (NOTE: login page should NOT have material design)
5. Login as idp1 administrator, e.g., username=admin & password=a
6. Click **Logout**
7. Click **Authentication** tab
8. Click **Test configured authentication sources**
9. Click **hub-discovery**
10. Click **Login with idp2** (NOTE: login page should have material design)
11. Login as idp2 administrator, e.g., username=admin & password=b

## i18n support
Translations are categorized by page in definition files located in the `dictionaries` directory.

Localization is affected by the configuration setting `language.available`.  Only language codes found in this property will be utilized.  
For example, if a translation is provided in Afrikaans for this module, the configuration must be adjusted to make 'af' an available
language.  If that's not done, the translation function will not utilize the translations even if provided.
