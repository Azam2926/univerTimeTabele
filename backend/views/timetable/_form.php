<?php

use common\models\Group;
use common\models\Room;
use common\models\Subject;
use common\models\Teacher;
use common\models\Timetable;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timetable-form" style="padding-top: 30px">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6" style="margin-left: calc(100%/12*3)">


            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'teacher_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Teacher::find()->all(), 'id', 'name'),
//                        'options' => ['placeholder' => 'Select a teacher ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'subject_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
//                        'options' => ['placeholder' => 'Select a Subject ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'room_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Room::find()->all(), 'id', 'name'),
//                        'options' => ['placeholder' => 'Select a Room ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'day')->widget(Select2::class, [
                        'data' => Timetable::WeekDays,
//                        'options' => ['placeholder' => 'Select a day ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'value' => $model->day
                    ]); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'start')->widget(Select2::class, [
                        'data' => Timetable::StartTime,
//                        'options' => ['placeholder' => 'Select a start ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'value' => $model->start
                    ]); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'end')->widget(Select2::class, [
                        'data' => Timetable::EndTime,
//                        'options' => ['placeholder' => 'Select a end ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'value' => $model->end
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">

                    <?= $form->field($model, 'groups')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Group::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Select a Group ...', 'multiple' => true],
                        'pluginOptions' => [
                            'tokenSeparators' => [',', ' '],
                            'maximumInputLength' => 2
                        ],
                        'toggleAllSettings' => [
                            'selectLabel' => '<i class="fa fa-check-circle"></i> Tag All',
                            'unselectLabel' => '<i class="fa fa-times-circle"></i> Untag All',
                            'selectOptions' => ['class' => 'text-success'],
                            'unselectOptions' => ['class' => 'text-danger'],
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

        </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>
