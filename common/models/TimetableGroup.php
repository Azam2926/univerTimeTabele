<?php

namespace common\models;

/**
 * This is the model class for table "timetable_group".
 *
 * @property int $id
 * @property int|null $timetable_id
 * @property int|null $group_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Group $group
 * @property Timetable $timetable
 */
class TimetableGroup extends \common\models\MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timetable_id', 'group_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['timetable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Timetable::className(), 'targetAttribute' => ['timetable_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timetable_id' => 'Timetable ID',
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
     * Gets query for [[Timetable]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimetable()
    {
        return $this->hasOne(Timetable::className(), ['id' => 'timetable_id']);
    }
}
