<?php

/* @see \app\controllers\SiteController::actionHistory() Action for this view. */

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $calculationsDP \yii\data\ActiveDataProvider */

$this->title = 'Calculator';
?>
<div class="site-history">
    <h2>Последние 10 вычислений</h2>
    <form method="POST" action="clear-history">
        <div class="form-group">
            <button type="submit" class="btn btn-danger">Очистить историю</button>
        </div>
    </form>
    <?= GridView::widget([
        'tableOptions' => [
            'class' => 'table table-condensed table-striped table-hover table-bordered'
        ],
        'emptyText' => 'Нет вычислений',
        'summary' => false,
        'dataProvider' => $calculationsDP,
        'columns' => [
            [
                'attribute' => 'created',
                'label' => 'Время'
            ],
            [
                'attribute' => 'expression',
                'label' => 'Выражение'
            ],
            [
                'attribute' => 'result',
                'label' => 'Результат'
            ],
        ]
    ]); ?>
</div>
