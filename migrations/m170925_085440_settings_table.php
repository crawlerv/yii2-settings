<?php

use yii\db\Migration;

/**
 * Class m170925_085440_settings_table
 */
class m170925_085440_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(50)->notNull(),
            'value' => $this->string(200)->notNull(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'create_date' => $this->integer(11)->notNull(),
            'update_date' => $this->integer(11)->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
