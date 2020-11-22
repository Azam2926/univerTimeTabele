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
class m201122_075250_create_timetable_table extends Migration
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
            'room' => $this->integer(),
            'teacher' => $this->integer(),
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

        // creates index for column `room`
        $this->createIndex(
            '{{%idx-timetable-room}}',
            '{{%timetable}}',
            'room'
        );

        // add foreign key for table `{{%room}}`
        $this->addForeignKey(
            '{{%fk-timetable-room}}',
            '{{%timetable}}',
            'room',
            '{{%room}}',
            'id',
            'CASCADE'
        );

        // creates index for column `teacher`
        $this->createIndex(
            '{{%idx-timetable-teacher}}',
            '{{%timetable}}',
            'teacher'
        );

        // add foreign key for table `{{%teacher}}`
        $this->addForeignKey(
            '{{%fk-timetable-teacher}}',
            '{{%timetable}}',
            'teacher',
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
            '{{%fk-timetable-room}}',
            '{{%timetable}}'
        );

        // drops index for column `room`
        $this->dropIndex(
            '{{%idx-timetable-room}}',
            '{{%timetable}}'
        );

        // drops foreign key for table `{{%teacher}}`
        $this->dropForeignKey(
            '{{%fk-timetable-teacher}}',
            '{{%timetable}}'
        );

        // drops index for column `teacher`
        $this->dropIndex(
            '{{%idx-timetable-teacher}}',
            '{{%timetable}}'
        );

        $this->dropTable('{{%timetable}}');
    }
}
