<?php
namespace crawlerv\settings\components\settings;

use crawlerv\settings\components\settings\loaders\CacheSettingsLoader;
use crawlerv\settings\components\settings\loaders\DbSettingsLoader;
use yii\base\BaseObject;
use yii\caching\CacheInterface;

class SettingsComponent extends BaseObject
{
    public $cachePrefix = 'webSettings';
    public $cacheComponent = 'cache';

    private $_settings = [];

    public function init()
    {
        parent::init();

        $settingsLoader = null;
        $cacheExists = false;
        /** @var CacheInterface $cacheComponent */
        $cacheComponent = \Yii::$app->get($this->cacheComponent);
        if ($cacheComponent && $cacheComponent->exists($this->cachePrefix)) {
            $settingsLoader = \Yii::createObject(CacheSettingsLoader::class, [$this->cachePrefix, $cacheComponent]);
            $cacheExists = true;
        } else
            $settingsLoader = \Yii::createObject(DbSettingsLoader::class);

        $this->_settings = $settingsLoader->load();
        if (!$cacheExists && $cacheComponent) {
            $cacheComponent->set($this->cachePrefix, $this->_settings);
        }
    }

    public function get($name)
    {
        if (isset($this->_settings[$name]))
            return $this->_settings[$name];

        return '';
    }
}