<?php
namespace crawlerv\settings\components\settings\loaders;

use crawlerv\settings\models\Settings;
use crawlerv\settings\components\settings\SettingsLoaderInterface;

class DbSettingsLoader implements SettingsLoaderInterface
{
    public function load()
    {
        $arSettings = [];
        foreach (Settings::find()->active()->asArray()->all() as $set) {
            $arSettings[$set['key']] = $set['value'];
        }

        return $arSettings;
    }
}