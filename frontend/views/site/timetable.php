<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $timetables array */
$this->title = 'Timetable';
$this->params['breadcrumbs'][] = $this->title;
//vdd($timetables);
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the Timetable page. </p>

    <div class="timetables">
        <?php foreach ($timetables as $day => $timetable): ?>
            <div class="asd">
                <h1><?= $day ?></h1>
                <div class="timetable">
                    <?php foreach ($timetable as $item): ?>
                        <ul>
                            <li><strong>Subject</strong>: <?= $item['subject'] ?></li>
                            <li><strong>Teacher</strong>: <?= $item['teacher'] ?></li>
                            <li><strong>Room</strong>: <?= $item['room'] ?></li>
                            <li><strong>Start</strong>: <?= $item['start'] ?></li>
                            <li><strong>End</strong>: <?= $item['start'] ?></li>
                        </ul>
                    <?php endforeach; ?>

                </div>
                <hr>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .timetable {
        display: flex;
    }
</style>
