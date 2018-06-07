<?php

use yii\db\Migration;

/**
 * Class m180607_071041_create_table_f4_contract
 */
class m180607_071041_create_table_f4_contract extends Migration
{

    /**
     * Тип движка таблиц
     *
     * @var string
     */
    private $tableOptions = 'ENGINE=InnoDB';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable(
            '{{%f4_contract}}',
            [
                'id' => $this->primaryKey(11),
                'insert_date' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата создания записи'),

                'policy_no' => $this->string(30)->notNull()->comment('№ договора'), //id
               

                'data_json' => $this->text()->notNull()->comment('Данные JSON'),

                'send_cis_date' => $this->datetime()->null()->defaultValue(null)->comment('Дата успешной отправки в КИС'),
                'send_cis_status_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('Статус отправки в КИС'),
                'send_cis_message' => $this->text()->notNull()->comment('Сообщение об отправке в КИС'),
                'send_cis_id_cis' => $this->integer(11)->null()->defaultValue(null)->comment('ID КИС'),
            ],
            $this->tableOptions
        );
        $this->addCommentOnTable('{{%f4_contract}}', 'Договоры страхования');
        $this->createIndex('idx_unique', '{{%f4_contract}}', ['policy_no'], true);


        $this->addForeignKey(
            'fk2-send_cis_status_id',
            '{{%f4_contract}}', 'send_cis_status_id',
            '{{%g_e_send_cis_status}}', 'id',
            'RESTRICT'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%f4_contract}}');
    }

}
