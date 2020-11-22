<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher_subject".
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $subject_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Subject $subject
 * @property Teacher $teacher
 */
class TeacherSubject extends \common\models\MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher_subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'subject_id'], 'required'],
            [['teacher_id', 'subject_id', 'created_at', 'updated_at'], 'integer'],
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
            'teacher_id' => 'Teacher ID',
            'subject_id' => 'Subject ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }
}
