<?php

//namespace common\models;
namespace crawlerv\settings\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property int $status
 * @property int $create_date
 * @property int $update_date
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value', 'status'], 'required'],
            [['status', 'create_date', 'update_date'], 'integer'],
            [['key'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 200],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => 'update_date',
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => \Yii::t('app', 'Key'),
            'value' => \Yii::t('app', 'Value'),
            'status' => \Yii::t('app', 'Status'),
            'create_date' => \Yii::t('app', 'Create Date'),
            'update_date' => \Yii::t('app', 'Update Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return SettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingsQuery(get_called_class());
    }
}
