<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teacher_subject}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%teacher}}`
 * - `{{%subject}}`
 */
class m201122_071823_create_teacher_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teacher_subject}}', [
            'id' => $this->primaryKey(),
            'teacher_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        // creates index for column `teacher_id`
        $this->createIndex(
            '{{%idx-teacher_subject-teacher_id}}',
            '{{%teacher_subject}}',
            'teacher_id'
        );

        // add foreign key for table `{{%teacher}}`
        $this->addForeignKey(
            '{{%fk-teacher_subject-teacher_id}}',
            '{{%teacher_subject}}',
            'teacher_id',
            '{{%teacher}}',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            '{{%idx-teacher_subject-subject_id}}',
            '{{%teacher_subject}}',
            'subject_id'
        );

        // add foreign key for table `{{%subject}}`
        $this->addForeignKey(
            '{{%fk-teacher_subject-subject_id}}',
            '{{%teacher_subject}}',
            'subject_id',
            '{{%subject}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%teacher}}`
        $this->dropForeignKey(
            '{{%fk-teacher_subject-teacher_id}}',
            '{{%teacher_subject}}'
        );

        // drops index for column `teacher_id`
        $this->dropIndex(
            '{{%idx-teacher_subject-teacher_id}}',
            '{{%teacher_subject}}'
        );

        // drops foreign key for table `{{%subject}}`
        $this->dropForeignKey(
            '{{%fk-teacher_subject-subject_id}}',
            '{{%teacher_subject}}'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            '{{%idx-teacher_subject-subject_id}}',
            '{{%teacher_subject}}'
        );

        $this->dropTable('{{%teacher_subject}}');
    }
}
