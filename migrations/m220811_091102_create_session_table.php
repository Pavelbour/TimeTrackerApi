<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%task}}`
 * - `{{%user}}`
 */
class m220811_091102_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'started_at' => $this->datetime()->notNull(),
            'finished_at' => $this->datetime(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-session-task_id}}',
            '{{%session}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-session-task_id}}',
            '{{%session}}',
            'task_id',
            '{{%task}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-session-user_id}}',
            '{{%session}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-session-user_id}}',
            '{{%session}}',
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
        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-session-task_id}}',
            '{{%session}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-session-task_id}}',
            '{{%session}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-session-user_id}}',
            '{{%session}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-session-user_id}}',
            '{{%session}}'
        );

        $this->dropTable('{{%session}}');
    }
}
