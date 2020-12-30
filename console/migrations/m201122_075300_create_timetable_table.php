<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%timetable}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%subject}}`
 * - `{{%room}}`
 * - `{{%teacher}}`
 */
class m201122_075300_create_timetable_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%timetable}}', [
            'id' => $this->primaryKey(),
            'time' => $this->json()->notNull(),
            'subject_id' => $this->integer(),
            'room_id' => $this->integer(),
            'teacher_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        // creates index for column `subject_id`
        $this->createIndex(
            '{{%idx-timetable-subject_id}}',
            '{{%timetable}}',
            'subject_id'
        );

        // add foreign key for table `{{%subject}}`
        $this->addForeignKey(
            '{{%fk-timetable-subject_id}}',
            '{{%timetable}}',
            'subject_id',
            '{{%subject}}',
            'id',
            'CASCADE'
        );

        // creates index for column `room_id`
        $this->createIndex(
            '{{%idx-timetable-room_id}}',
            '{{%timetable}}',
            'room_id'
        );

        // add foreign key for table `{{%room}}`
        $this->addForeignKey(
            '{{%fk-timetable-room_id}}',
            '{{%timetable}}',
            'room_id',
            '{{%room}}',
            'id',
            'CASCADE'
        );

        // creates index for column `teacher_id`
        $this->createIndex(
            '{{%idx-timetable-teacher_id}}',
            '{{%timetable}}',
            'teacher_id'
        );

        // add foreign key for table `{{%teacher}}`
        $this->addForeignKey(
            '{{%fk-timetable-teacher_id}}',
            '{{%timetable}}',
            'teacher_id',
            '{{%teacher}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%subject}}`
        $this->dropForeignKey(
            '{{%fk-timetable-subject_id}}',
            '{{%timetable}}'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            '{{%idx-timetable-subject_id}}',
            '{{%timetable}}'
        );

        // drops foreign key for table `{{%room}}`
        $this->dropForeignKey(
            '{{%fk-timetable-room_id}}',
            '{{%timetable}}'
        );

        // drops index for column `room_id`
        $this->dropIndex(
            '{{%idx-timetable-room_id}}',
            '{{%timetable}}'
        );

        // drops foreign key for table `{{%teacher}}`
        $this->dropForeignKey(
            '{{%fk-timetable-teacher_id}}',
            '{{%timetable}}'
        );

        // drops index for column `teacher_id`
        $this->dropIndex(
            '{{%idx-timetable-teacher_id}}',
            '{{%timetable}}'
        );

        $this->dropTable('{{%timetable}}');
    }
}
