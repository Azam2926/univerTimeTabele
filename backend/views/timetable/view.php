<?php

use common\models\Timetable;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Timetables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);


?>
<div class="timetable-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'label' => 'Subject',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/subject/view?id=$model->subject_id'>{$model->subject->name}</a>";
                }
            ],

            [
                'attribute' => 'room_id',
                'label' => 'Room',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/room/view?id=$model->room_id'>{$model->room->name}</a>";
                }
            ],
            [
                'attribute' => 'teacher_id',
                'label' => 'Teacher',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/room/view?id=$model->teacher_id'>{$model->teacher->name}</a>";
                }
            ],
            [
                'label' => 'Groups',
                'format' => 'html',
                'value' => function ($model) {
                    $txt = '';
                    foreach ($model->groups as $group) {
                        $txt .= "<a href='/admin/group/view?id=$group->id'>$group->name</a> <br> ";
                    }
                    return $txt;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
