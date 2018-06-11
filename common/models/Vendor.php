<?php
/**
 * Created by PhpStorm.
 * User: Мария
 * Date: 10.06.2018
 * Time: 21:24
 */

namespace common\models;


use Ramsey\Uuid\Uuid;
use yii\db\ActiveRecord;

class Vendor extends ActiveRecord
{
    public function createUUID()
    {
        return $this->uuid = (string)Uuid::uuid4();
    }

    public function rules()
    {
        return [
            [['name', 'range_min', 'range_max', 'price', 'balance'], 'required'],
            ['name', 'trim'],
            [['range_min', 'range_max'], 'match', 'pattern' => "/^\d{3}$/"],
            [['price', 'balance'], 'integer']
        ];
    }
}