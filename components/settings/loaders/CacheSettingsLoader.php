<?php
namespace crawlerv\settings\components\settings\loaders;

use crawlerv\settings\components\settings\SettingsLoaderInterface;
use yii\caching\CacheInterface;

class CacheSettingsLoader implements SettingsLoaderInterface
{
    private $_cachKey;

    /** @var  CacheInterface */
    private $_cacheComponent;

    public function __construct($cacheKey, $cacheComponent)
    {
        if (!$cacheKey)
            throw new \DomainException('Cache key is required for Settings component');

        if (!$cacheComponent)
            throw new \DomainException('Cache component is required for Settings component');

        $this->_cachKey = $cacheKey;
        $this->_cacheComponent = $cacheComponent;
    }

    public function load()
    {
        return $this->_cacheComponent->get($this->_cachKey);
    }
}