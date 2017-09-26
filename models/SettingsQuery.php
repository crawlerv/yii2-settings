<?php

//namespace common\models;
namespace crawlerv\settings\models;

use common\helpers\StatusHelper;

/**
 * This is the ActiveQuery class for [[Settings]].
 *
 * @see Settings
 */
class SettingsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this
            ->select(['key', 'value'])
            ->andWhere('status=:status' , [':status' => StatusHelper::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     * @return Settings[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Settings|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
