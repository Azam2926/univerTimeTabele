<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $user_id
 * @property int|null $group_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Group $group
 * @property User $user
 */
class Student extends MyModel
{
    public $timetables;

    public function afterFind()
    {
        $timetablesByGroup = TimetableGroup::findAll(['group_id' => $this->group_id]);
        foreach ($timetablesByGroup as $timetableGroup)
            $timetables[Timetable::WeekDays[$timetableGroup->timetable->time['day']]][] = [
                'start' => Timetable::StartTime[$timetableGroup->timetable->time['start']],
                'end' => Timetable::EndTime[$timetableGroup->timetable->time['end']],
                'subject' => $timetableGroup->timetable->subject->name,
                'teacher' => $timetableGroup->timetable->teacher->name,
                'room' => $timetableGroup->timetable->room->name ];

        if (!empty($timetables))
            $this->timetables = $timetables;

        parent::afterFind();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
