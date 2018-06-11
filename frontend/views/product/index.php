<?php

/* @var $this yii\web\View */

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'length',
        'width',
        'height',
        'price',
        'balance',
        'vendor_name',
        'name_category'
    ],
]);

?>


