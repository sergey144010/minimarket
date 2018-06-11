<?php

namespace frontend\controllers;


use yii\web\Controller;
use common\models\Product;
use yii\data\ArrayDataProvider;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $product = new Product();
        $dataProvider = new ArrayDataProvider([
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
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCheck()
    {
        $model = new Product();
        $lengths = Product::getLengthAll();
        $data = '<select id="select-length" class="form-control" aria-required="true">';
        $data .= '<option disabled selected>Select length</option>';
        foreach ($lengths as $key => $val) {
            $data .= '<option value="'.$key.'">'.$val.'</option>';
        };
        $data .= '</select>';
        return $this->render('check', [
            'model' => $model,
            'data' => $data
        ]);
    }

    public function actionGetLengthAll()
    {
        return json_encode(Product::getLengthAll());
    }

    public function actionGetWidthAll()
    {
        return json_encode(Product::getWidthAll());
    }

    public function actionGetHeightAll()
    {
        return json_encode(Product::getHeightAll());
    }

    public function getWidth($length)
    {
        return json_encode(Product::getWidthByLength($length));
    }

    public function actionGetWidth($length)
    {
        $data_raw = json_decode($this->getWidth($length));
        if(empty($data_raw)){return 'Not found';};
        $data = '<select id="select-width" class="form-control" aria-required="true">';
        $data .= '<option disabled selected>Select width</option>';
        foreach ($data_raw as $key => $val) {
            $data .= '<option value="'.$key.'">'.$val.'</option>';
        };
        $data .= '</select>';
        return $data;
    }

    public function getHeight($width)
    {
        return json_encode(Product::getHeightByWidth($width));
    }

    public function actionGetHeight($width)
    {
        $data_raw = json_decode($this->getHeight($width));
        if(empty($data_raw)){return 'Not found';};
        $data = '<select id="select-height" class="form-control" aria-required="true">';
        $data .= '<option disabled selected>Select height</option>';
        foreach ($data_raw as $key => $val) {
            $data .= '<option value="'.$key.'">'.$val.'</option>';
        };
        $data .= '</select>';
        return $data;
    }

    public function getBalance($vendor)
    {
        $model = new Product();
        return $model->getVendorByRange($vendor);
    }

    public function actionGetBalance($vendor)
    {
        $vendor = $this->getBalance($vendor);
        if(empty($vendor)){
            return '<b>Vendor not found</b>';
        };
        return '<b>Vendor: </b>'.$vendor['name'].' <b>Price: </b>'.$vendor['price'].' <b>Balance: </b>'.$vendor['balance'];
    }
}