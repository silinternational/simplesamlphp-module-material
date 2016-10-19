# ssp-theme-material
Material Design theme for use with SimpleSAMLphp 

## Configuration

Update `/simplesamlphp/config/config.php`:

```
'theme.use' => 'themematerial:material'
```

## Testing theme

1. Login to simplesaml's admin page, `//yourhost/module.php/core/loginuserpass.php`
2. Click **Authentication** tab
3. Click **Test configured authentication sources**
4. Click **auth-choices** (this list is built up from `config/authsources.php`)
