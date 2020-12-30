<?php

namespace common\models;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "timetable".
 *
 * @property int $id
 * @property string $time
 * @property int|null $subject_id
 * @property int|null $room_id
 * @property int|null $teacher_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Room $room
 * @property Subject $subject
 * @property Teacher $teacher
 * @property TimetableGroup[] $timetableGroups
 * @property Group[]|array $groups
 */
class Timetable extends MyModel
{
    const WeekDays = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];
    const StartTime = [
        '08:30',
        '10:00',
        '11:30'
    ];
    const EndTime = [
        '09:50',
        '11:20',
        '12:50'
    ];

    public $day;
    public $start;
    public $end;
    public $groups;

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->groups) {
            if (!$insert)
                foreach ($this->timetableGroups as $item)
                    $item->delete();

            foreach ($this->groups as $group) {
                $model = new TimetableGroup();
                $model->timetable_id = $this->id;
                $model->group_id = $group;
                if (!$model->save())
                    vdd('not ok Timetable model afterSave()');
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        $this->time = [
            'day' => $this->day,
            'start' => $this->start,
            'end' => $this->end];
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->day = $this->time['day'];
        $this->start = $this->time['start'];
        $this->end = $this->time['end'];

        foreach ($this->timetableGroups as $item) {
            $this->groups[] = Group::findOne($item->group_id);
        }
        parent::afterFind();
    }

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
            [['day', 'start', 'end', 'groups'], 'required'],
            [['subject_id', 'room_id', 'teacher_id'], 'required'],
            [['time'], 'safe'],
            [['subject_id', 'room_id', 'teacher_id'], 'integer'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher_id' => 'id']],
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
            'room_id' => 'Room ID',
            'teacher_id' => 'Teacher ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }

    /**
     * Gets query for [[TimetableGroups]].
     *
     * @return ActiveQuery
     */
    public function getTimetableGroups()
    {
        return $this->hasMany(TimetableGroup::className(), ['timetable_id' => 'id']);
    }
}
