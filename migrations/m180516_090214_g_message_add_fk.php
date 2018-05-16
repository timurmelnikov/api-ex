<?php

use yii\db\Migration;

/**
 * Class m180516_090214_g_message_add_fk
 */
class m180516_090214_g_message_add_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->addForeignKey(
            'fk-message_type_id',
            '{{%g_message}}',
            'message_type_id',
            '{{%g_e_message_type}}',
            'id',
            'RESTRICT'
        );


        $this->addForeignKey(
            'fk-message_status_id',
            '{{%g_message}}',
            'message_status_id',
            '{{%g_e_message_status}}',
            'id',
            'RESTRICT'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180516_090214_g_message_add_fk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180516_090214_g_message_add_fk cannot be reverted.\n";

        return false;
    }
    */
}
