<?php
/**
 * Created by PhpStorm.
 * User: Мария
 * Date: 10.06.2018
 * Time: 20:28
 */

namespace common\models;


use yii\db\ActiveRecord;

class RelationProductCategory extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%relation_product_category%}}";
    }
}