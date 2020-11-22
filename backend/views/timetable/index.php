<?php

use common\models\Timetable;
use yii\helpers\Html;
use yii\grid\GridView;

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
                }
            ],

            [
                'attribute' => 'room_id',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/room/view?id=$model->room_id'>{$model->room->name}</a>";
                }
            ],
            [
                'attribute' => 'teacher_id',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/room/view?id=$model->teacher_id'>{$model->teacher->name}</a>";
                }
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
