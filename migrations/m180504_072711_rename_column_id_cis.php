<?php

use yii\db\Migration;

/**
 * Class m180504_072711_rename_column_id_cis
 */
class m180504_072711_rename_column_id_cis extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameColumn('{{%f2_contract}}', 'id_cis', 'send_cis_id_cis');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180504_072711_rename_column_id_cis cannot be reverted.\n";

        return false;
    }

}
