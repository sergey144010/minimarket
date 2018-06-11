<?php
/**
 * Created by PhpStorm.
 * User: Мария
 * Date: 10.06.2018
 * Time: 21:23
 */

namespace backend\controllers;

use yii\data\ActiveDataProvider;
use common\models\Vendor;
use Yii;
use yii\web\Controller;

class VendorController extends Controller
{
    public function actionNew()
    {
        $vendor = new Vendor();
        $success = null;
        if(Yii::$app->request->isPost){
            $vendor->load(Yii::$app->request->post());
            if($vendor->validate()){
                $vendor->createUUID();
                if($vendor->save()){$success = true;}else{$success = false;};
            };
        };

        return $this->render('index', [
            'model' => $vendor,
            'success' => $success
        ]);
    }

    public function actionView($id)
    {
        
    }

    public function actionUpdate($id)
    {
        
    }

    public function actionList()
    {
        $query = Vendor::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDelete($id)
    {
        $vendor = Vendor::find()->where(['uuid'=>$id])->one();
        $vendor->delete();
        return $this->redirect(['vendor/list']);
    }
}