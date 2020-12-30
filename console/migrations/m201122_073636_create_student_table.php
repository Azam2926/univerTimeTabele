<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%group}}`
 */
class m201122_073636_create_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'user_id' => $this->integer(),
            'group_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-student-user_id}}',
            '{{%student}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-student-user_id}}',
            '{{%student}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            '{{%idx-student-group_id}}',
            '{{%student}}',
            'group_id'
        );

        // add foreign key for table `{{%group}}`
        $this->addForeignKey(
            '{{%fk-student-group_id}}',
            '{{%student}}',
            'group_id',
            '{{%group}}',
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
            '{{%fk-student-user_id}}',
            '{{%student}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-student-user_id}}',
            '{{%student}}'
        );

        // drops foreign key for table `{{%group}}`
        $this->dropForeignKey(
            '{{%fk-student-group_id}}',
            '{{%student}}'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            '{{%idx-student-group_id}}',
            '{{%student}}'
        );

        $this->dropTable('{{%student}}');
    }
}
