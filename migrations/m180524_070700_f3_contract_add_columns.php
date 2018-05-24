<?php

use yii\db\Migration;

/**
 * Class m180524_070700_f3_contract_add_columns
 */
class m180524_070700_f3_contract_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%f3_contract}}', 'product', $this->string(30)->notNull()->comment('Продукт')->after('insert_date'));
        $this->dropIndex('idx_unique', '{{%f3_contract}}');
        $this->createIndex('idx_unique', '{{%f3_contract}}', ['contract_id', 'product', 'insurance_state'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180524_070700_f3_contract_add_columns cannot be reverted.\n";

        return false;
    }

}
