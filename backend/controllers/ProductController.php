<?php

namespace backend\controllers;


use common\models\RelationProductCategory;
use Yii;
use common\models\Category;
use common\models\Product;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class ProductController extends Controller
{
    public function actionNew()
    {
        $product = new Product();
        $success = null;
        if(Yii::$app->request->isPost){
            $product->load(Yii::$app->request->post());
            if($product->validate()){
                $product->createUUID();
                $product->save();
                $relation = new RelationProductCategory();
                $relation->uuid_product = $product->uuid;
                $relation->uuid_category = $product->category;
                if($relation->save()){$success = true;}else{$success = false;};
            };
        };

        $findCategorys = Category::find()->all();
        $categorys = [];
        foreach ($findCategorys as $category) {
            $categorys[$category->uuid] = $category->name;
        };

        return $this->render('index', [
            'model' => $product,
            'categorys' => $categorys,
            'success' => $success
        ]);
    }

    public function actionList()
    {
        $query = Product::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDelete($id)
    {
        $vendor = Product::find()->where(['uuid'=>$id])->one();
        $vendor->delete();
        return $this->redirect(['product/list']);
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