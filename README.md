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
if `RECAPTCHA_REQUIRED` is found in `$this->data['errorcode']` **and** a site key has been provided in the 
environment, e.g., `RECAPTCHA_SITE_KEY`, the username/password page will require the user prove his/her humanity.

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
1. Click **Configuration** tab

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
