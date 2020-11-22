<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property int $id
 * @property string $time
 * @property int|null $subject_id
 * @property int|null $room
 * @property int|null $teacher
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Room $room0
 * @property Subject $subject
 * @property Teacher $teacher0
 * @property TimetableGroup[] $timetableGroups
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'required'],
            [['time'], 'safe'],
            [['subject_id', 'room', 'teacher', 'created_at', 'updated_at'], 'integer'],
            [['room'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['teacher'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'subject_id' => 'Subject ID',
            'room' => 'Room',
            'teacher' => 'Teacher',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Room0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom0()
    {
        return $this->hasOne(Room::className(), ['id' => 'room']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * Gets query for [[Teacher0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher0()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher']);
    }

    /**
     * Gets query for [[TimetableGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimetableGroups()
    {
        return $this->hasMany(TimetableGroup::className(), ['timetable_id' => 'id']);
    }
}
