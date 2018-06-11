<?php
/* @var $this yii\web\View */

use yii\grid\ActionColumn;

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'price',
        'balance',
        'range_min',
        'range_max',
        [
            'class' => ActionColumn::className(),
            'controller' => 'vendor',
            'template' => '{delete}',
        ],
    ],
]);

?>