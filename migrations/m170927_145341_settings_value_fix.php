<?php

use yii\db\Migration;

/**
 * Class m170927_145341_settings_value_fix
 */
class m170927_145341_settings_value_fix extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('{{%settings}}', 'value', "TEXT NOT NULL COLLATE 'utf8_unicode_ci'");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->alterColumn('{{%settings}}', 'value', "VARCHAR(200) NOT NULL COLLATE 'utf8_unicode_ci'");
    }
}
