<?php
/**
 * Created by PhpStorm.
 * User: Мария
 * Date: 10.06.2018
 * Time: 4:41
 */

namespace backend\controllers;


use Yii;
use common\models\Category;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    public function actionNew()
    {
        $category = new Category();
        $success = null;

        if(Yii::$app->request->isPost){
            $category->load(Yii::$app->request->post());
            if($category->validate()){
                $category->createUUID();
                if($category->save()){$success = true;}else{$success = false;};
            };
        };

        return $this->render('index', [
            'model' => $category,
            'success' => $success
        ]);
    }

    public function actionList()
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDelete($id)
    {
        $vendor = Category::find()->where(['uuid'=>$id])->one();
        $vendor->delete();
        return $this->redirect(['category/list']);
    }
}