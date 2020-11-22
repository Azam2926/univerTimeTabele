<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%timetable_group}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%timetable}}`
 * - `{{%group}}`
 */
class m201122_075429_create_timetable_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%timetable_group}}', [
            'id' => $this->primaryKey(),
            'timetable_id' => $this->integer(),
            'group_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        // creates index for column `timetable_id`
        $this->createIndex(
            '{{%idx-timetable_group-timetable_id}}',
            '{{%timetable_group}}',
            'timetable_id'
        );

        // add foreign key for table `{{%timetable}}`
        $this->addForeignKey(
            '{{%fk-timetable_group-timetable_id}}',
            '{{%timetable_group}}',
            'timetable_id',
            '{{%timetable}}',
            'id',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            '{{%idx-timetable_group-group_id}}',
            '{{%timetable_group}}',
            'group_id'
        );

        // add foreign key for table `{{%group}}`
        $this->addForeignKey(
            '{{%fk-timetable_group-group_id}}',
            '{{%timetable_group}}',
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
        // drops foreign key for table `{{%timetable}}`
        $this->dropForeignKey(
            '{{%fk-timetable_group-timetable_id}}',
            '{{%timetable_group}}'
        );

        // drops index for column `timetable_id`
        $this->dropIndex(
            '{{%idx-timetable_group-timetable_id}}',
            '{{%timetable_group}}'
        );

        // drops foreign key for table `{{%group}}`
        $this->dropForeignKey(
            '{{%fk-timetable_group-group_id}}',
            '{{%timetable_group}}'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            '{{%idx-timetable_group-group_id}}',
            '{{%timetable_group}}'
        );

        $this->dropTable('{{%timetable_group}}');
    }
}
