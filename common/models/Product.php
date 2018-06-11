<?php
/**
 * Created by PhpStorm.
 * User: Мария
 * Date: 10.06.2018
 * Time: 16:53
 */

namespace common\models;


use yii\db\ActiveRecord;
use Ramsey\Uuid\Uuid;

class Product extends ActiveRecord
{
    private $category;

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function createUUID()
    {
        return $this->uuid = (string)Uuid::uuid4();
    }

    public function rules()
    {
        return [
            [['name', 'length', 'width', 'height', 'category'], 'required'],
            ['name', 'trim'],
            [['length', 'width', 'height'], 'match', 'pattern' => "/^[1-5]{1}$/"]
        ];
    }

    public function getAllProductWithPrice()
    {
        $sql = 'SELECT 
                     product.uuid, 
                     product.name, 
                     product.length, 
                     product.width, 
                     product.height, 
                     CONCAT (length, width, height) as vendor, 
                     category.uuid as uuid_category, 
                     category.name as name_category 
                     FROM product
                      LEFT JOIN relation_product_category as relation
                      ON product.uuid = relation.uuid_product
                      LEFT JOIN category 
                      ON relation.uuid_category = category.uuid;';

        $products =  \Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($products as $key => $product) {
            $sql = 'SELECT * FROM vendor WHERE range_min <= '.$product['vendor'].' and range_max >= '.$product['vendor'].';';
            $vendor =  \Yii::$app->db->createCommand($sql)->queryOne();
            $products[$key]['uuid'] = $vendor['uuid'];
            $products[$key]['vendor_name'] = $vendor['name'];
            $products[$key]['price'] = $vendor['price'];
            $products[$key]['balance'] = $vendor['balance'];
        };
        return $products;
    }

    public function getVendorByRange($range)
    {
        $sql = 'SELECT * FROM vendor WHERE range_min <= '.$range.' and range_max >= '.$range.';';
        return \Yii::$app->db->createCommand($sql)->queryOne();
    }

    public static function getLengthAll()
    {
        return self::prepareData('length');
    }

    public static function getWidthAll()
    {
        return self::prepareData('width');
    }

    public static function getHeightAll()
    {
        return self::prepareData('height');
    }

    private static function prepareData($name)
    {
        $products = self::find()->select([$name])->asArray()->all();
        $data = [];
        foreach ($products as $product) {
            $data[$product[$name]] = $product[$name];
        };
        asort($data);
        return $data;
    }

    public static function getWidthByLength($length)
    {
        $products = self::find()->select(['width'])->where(['length' => $length])->asArray()->all();
        $data = [];
        foreach ($products as $product) {
            $data[$product['width']] = $product['width'];
        };
        asort($data);
        return $data;
    }

    public static function getHeightByWidth($width)
    {
        $products = self::find()->select(['height'])->where(['width' => $width])->asArray()->all();
        $data = [];
        foreach ($products as $product) {
            $data[$product['height']] = $product['height'];
        };
        asort($data);
        return $data;
    }
}