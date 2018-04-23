<?php

use yii\db\Migration;

/**
 * Class m180423_090757_f2_contract_add_fk
 */
class m180423_090757_f2_contract_add_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-send_cis_status_id',
            '{{%f2_contract}}',
            'send_cis_status_id',
            '{{%g_e_send_cis_status}}',
            'id_status',
            'RESTRICT'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180423_090757_f2_contract_add_fk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180423_090757_f2_contract_add_fk cannot be reverted.\n";

        return false;
    }
    */
}
