<?php

use yii\db\Migration;

/**
 * Class m180419_120040_f2_contract_add_columns
 */
class m180419_120040_f2_contract_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%f2_contract}}', 'id_blank', $this->integer(11)->null()->comment('ID бланка КИС')->after('data_json')); 
        $this->addColumn('{{%f2_contract}}', 'place_name', $this->string(50)->null()->comment('Место регистрации')->after('data_json'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180419_120040_f2_contract_add_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_120040_f2_contract_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
