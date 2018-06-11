<?php

namespace backend\controllers;


use common\models\Product;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $product = new Product();
        $provider = new ArrayDataProvider([
            'allModels' => $product->getAllProductWithPrice(),
            'sort' => [
                'attributes' => [
                    'name',
                    'length',
                    'width',
                    'height',
                    'price',
                    'balance',
                    'vendor_name',
                    'name_category'
                ],
            ]
        ]);

        return $this->render('index', [
            'provider' => $provider
        ]);
    }
}