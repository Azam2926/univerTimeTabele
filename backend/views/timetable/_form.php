<?php

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
                    <label class="control-label">Day:</label>
                    <?= Select2::widget([
                        'name' => 'Timetable[day]',
                        'data' => Timetable::WeekDays,
                        'options' => ['placeholder' => 'Select a day ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'value' => $model->day
                    ]); ?>
                </div>
                <div class="col-lg-4">
                    <label class="control-label">Start:</label>
                    <?= Select2::widget([
                        'name' => 'Timetable[start]',
                        'data' => Timetable::StartTime,
                        'options' => ['placeholder' => 'Select a start ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'value' => $model->start
                    ]); ?>
                </div>
                <div class="col-lg-4">
                    <label class="control-label">End:</label>
                    <?= Select2::widget([
                        'name' => 'Timetable[end]',
                        'data' => Timetable::EndTime,
                        'options' => ['placeholder' => 'Select a end ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'value' => $model->end
                    ]); ?>
                </div>
            </div>
            <br>

            <?= $form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(\common\models\Subject::find()->all(), 'id', 'name')) ?>

            <?= $form->field($model, 'room_id')->dropDownList(ArrayHelper::map(\common\models\Room::find()->all(), 'id', 'name')) ?>

            <?= $form->field($model, 'teacher_id')->dropDownList(ArrayHelper::map(\common\models\Teacher::find()->all(), 'id', 'name')) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

        </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>
