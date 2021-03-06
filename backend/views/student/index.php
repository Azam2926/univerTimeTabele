<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/user/view?id=$model->user_id' >$model->user_id</a>";
                }
            ],
            [
                'attribute' => 'group_id',
                'format' => 'html',
                'value' => function ($model) {
                    return "<a href='/admin/group/view?id=$model->group_id' >$model->group_id</a>";
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
