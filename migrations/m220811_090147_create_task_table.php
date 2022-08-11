<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%project}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m220811_090147_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'task_name' => $this->string()->notNull(),
            'description' => $this->text(),
            'created_by' => $this->integer()->notNull(),
            'charged_to' => $this->integer(),
            'started_at' => $this->datetime(),
            'finished_at' => $this->datetime(),
            'estimated_finished_at' => $this->datetime(),
        ]);

        // creates index for column `project_id`
        $this->createIndex(
            '{{%idx-task-project_id}}',
            '{{%task}}',
            'project_id'
        );

        // add foreign key for table `{{%project}}`
        $this->addForeignKey(
            '{{%fk-task-project_id}}',
            '{{%task}}',
            'project_id',
            '{{%project}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-task-created_by}}',
            '{{%task}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-task-created_by}}',
            '{{%task}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `charged_to`
        $this->createIndex(
            '{{%idx-task-charged_to}}',
            '{{%task}}',
            'charged_to'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-task-charged_to}}',
            '{{%task}}',
            'charged_to',
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
        // drops foreign key for table `{{%project}}`
        $this->dropForeignKey(
            '{{%fk-task-project_id}}',
            '{{%task}}'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            '{{%idx-task-project_id}}',
            '{{%task}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-task-created_by}}',
            '{{%task}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-task-created_by}}',
            '{{%task}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-task-charged_to}}',
            '{{%task}}'
        );

        // drops index for column `charged_to`
        $this->dropIndex(
            '{{%idx-task-charged_to}}',
            '{{%task}}'
        );

        $this->dropTable('{{%task}}');
    }
}
