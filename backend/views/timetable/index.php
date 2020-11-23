<?php

use common\models\Group;
use common\models\Room;
use common\models\Subject;
use common\models\Teacher;
use common\models\Timetable;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Timetables';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="timetable-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Timetable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'time',
                'format' => 'html',
                'value' => function ($model) {
                    $day = Timetable::WeekDays[$model->time['day']];
                    $start = Timetable::StartTime[$model->time['start']];
                    $end = Timetable::EndTime[$model->time['end']];
                    return "<strong>Day</strong> : $day <br> <strong>Start</strong> : $start <br> <strong>End</strong> : $end <br>";
                }
            ],
            [
                'attribute' => 'subject_id',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/subject/view?id=$model->subject_id'>{$model->subject->name}</a>";
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'subject_id',
                    'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a subject ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],

            [
                'attribute' => 'room_id',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/room/view?id=$model->room_id'>{$model->room->name}</a>";
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'room_id',
                    'data' => ArrayHelper::map(Room::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a room ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'teacher_id',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/room/view?id=$model->teacher_id'>{$model->teacher->name}</a>";
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'teacher_id',
                    'data' => ArrayHelper::map(Teacher::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a teacher ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],

            [
                'label' => 'Groups',
                'format' => 'html',
                'value' => function ($model) {
                    $txt = '';
                    foreach ($model->groups as $group) {
                        $txt .= "<a href='/admin/group/view?id=$group->id'>$group->name</a> <br>";
                    }
                    return $txt;
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'groups',
                    'data' => ArrayHelper::map(Group::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a group ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>
