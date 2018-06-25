<?php

use yii\db\Migration;

/**
 * Class m180618_080149_migrate
 */
class m180618_080149_migrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 802,
            'name' => 'Ошибка Удаления',
            'note' => 'STATUS_ERROR_REMOVER - Не удалось удалить договор',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180618_080149_migrate cannot be reverted.\n";

        return false;
    }

    /*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
echo "m180618_080149_migrate cannot be reverted.\n";

return false;
}
 */
}
