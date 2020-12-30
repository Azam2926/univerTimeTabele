<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $user_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 * @property TeacherSubject[] $teacherSubjects
 * @property Timetable[] $timetables
 */
class Teacher extends \common\models\MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', ], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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

    /**
     * Gets query for [[TeacherSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherSubjects()
    {
        return $this->hasMany(TeacherSubject::className(), ['teacher_id' => 'id']);
    }

    /**
     * Gets query for [[Timetables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimetables()
    {
        return $this->hasMany(Timetable::className(), ['teacher' => 'id']);
    }
}
