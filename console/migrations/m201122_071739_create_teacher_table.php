<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teacher}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m201122_071739_create_teacher_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teacher}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-teacher-user_id}}',
            '{{%teacher}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-teacher-user_id}}',
            '{{%teacher}}',
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
            '{{%fk-teacher-user_id}}',
            '{{%teacher}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-teacher-user_id}}',
            '{{%teacher}}'
        );

        $this->dropTable('{{%teacher}}');
    }
}
