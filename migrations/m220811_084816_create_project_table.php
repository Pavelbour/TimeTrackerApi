<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m220811_084816_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'project_name' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-project-user_id}}',
            '{{%project}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-project-user_id}}',
            '{{%project}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-project-user_id}}',
            '{{%project}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-project-user_id}}',
            '{{%project}}'
        );

        $this->dropTable('{{%project}}');
    }
}
