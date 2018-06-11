<?php
/* @var $this yii\web\View */

use yii\grid\ActionColumn;

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        [
            'class' => ActionColumn::className(),
            'controller' => 'category',
            'template' => '{delete}',
        ],
    ],
]);

?>