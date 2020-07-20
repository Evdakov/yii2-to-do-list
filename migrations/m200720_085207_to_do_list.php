<?php

use yii\db\Migration;
use app\models\ToDo;

/**
 * Class m200720_085207_to_do_list
 */
class m200720_085207_to_do_list extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TYPE priorityEnum AS ENUM ('"
            .implode("','", [
                ToDo::PRIORITY_LOW,
                ToDo::PRIORITY_MEDIUM,
                ToDo::PRIORITY_HIGH
            ])."')");

        $this->createTable('{{%to_do_list}}', [
            'id' => $this->primaryKey(),
            'caption' => $this->string()->notNull(),
            'description' => $this->text(),
            'complete_date' => $this->dateTime()->defaultValue(null),
            'priority' => "priorityEnum DEFAULT '".ToDo::PRIORITY_LOW."'",
            'is_complete' => $this->boolean()->notNull()->defaultValue(false),
        ]);

        $this->createIndex('complete_date', '{{%to_do_list}}', 'complete_date');
        $this->createIndex('priority', '{{%to_do_list}}', 'priority');
        $this->createIndex('is_complete', '{{%to_do_list}}', 'is_complete');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%to_do_list}}');

        $this->execute('DROP TYPE priorityEnum');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200720_085207_to_do_list cannot be reverted.\n";

        return false;
    }
    */
}
