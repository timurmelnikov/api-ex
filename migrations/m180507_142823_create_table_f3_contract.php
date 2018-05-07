<?php

use yii\db\Migration;

/**
 * Class m180507_142823_create_table_f3_contract
 */
class m180507_142823_create_table_f3_contract extends Migration
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
            '{{%f3_contract}}',
            [
                'id' => $this->primaryKey(11),
                'insert_date' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата создания записи'),

                'contract_id' => $this->string(30)->notNull()->comment('ID договора'), //id
                'insurance_state' => $this->string(30)->notNull()->comment('Состояние договора'),
                //'insurance_paid_at' =>  $this->datetime()->null()->defaultValue(null)->comment('Договор оплачен'),

                'data_json' => $this->text()->notNull()->comment('Данные JSON'),

                'send_cis_date' => $this->datetime()->null()->defaultValue(null)->comment('Дата успешной отправки в КИС'),
                'send_cis_status_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('Статус отправки в КИС'),
                'send_cis_message' => $this->text()->notNull()->comment('Сообщение об отправке в КИС'),
                'send_cis_id_cis' => $this->integer(11)->null()->defaultValue(null)->comment('ID КИС'),
            ],
            $this->tableOptions
        );
        $this->addCommentOnTable('{{%f3_contract}}', 'Договоры страхования');
        $this->createIndex('idx_unique', '{{%f3_contract}}', ['contract_id'], true);
        // $this->createIndex('idx_sagr', '{{%f3_contract}}', ['sagr'], false);
        // $this->createIndex('idx_nagr', '{{%f3_contract}}', ['nagr'], false);

        $this->addForeignKey(
            'fk1-send_cis_status_id',
            '{{%f3_contract}}', 'send_cis_status_id',
            '{{%g_e_send_cis_status}}', 'id',
            'RESTRICT'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%f3_contract}}');
    }

}
