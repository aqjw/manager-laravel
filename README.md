## Installation

Require this package with composer. It is recommended to only require the package for development.

```shell
composer require aqjw/manager-laravel --dev
```

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php
```php
Aqjw\ManagerLaravel\ManagerLaravelServiceProvider::class,
```

Copy the package assets to your local config with the publish command:
```shell
php artisan vendor:publish --tag=public --force
```

