Yii2 Settings
=========
Simple component to store project related variables in cache or db

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist crawlerv/yii2-settings "dev-master"
```

or add

```
"crawlerv/yii2-settings": "dev-master"
```

to the require section of your `composer.json` file.

### Migration

Migration run

```php
yii migrate --migrationPath=@vendor/crawlerv/yii2-settings/migrations
```

### Config module in config/main.php

```php
    'modules' => [
        'settings' => [
            'class' => 'crawlerv\settings\SettingsModule'
        ],
    ],
```


### Config component in config/main.php

```php
    'components' => [
        'settings' => [
            'class' => 'crawlerv\settings\components\settings\SettingsComponent',
            'cacheComponent' => 'cache', // cache component name to use - cache by default
            'cachePrefix' => 'webSettings' // cache key name - webSettings by default
        ],
    ],
```

### CRUD for settings available at

```php
/settings/settings/
```

### Component usage

```php
\Yii::$app->settings->get('keyName');
```