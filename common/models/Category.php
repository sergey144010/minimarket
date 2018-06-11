<?php
/**
 * Created by PhpStorm.
 * User: Мария
 * Date: 10.06.2018
 * Time: 4:30
 */

namespace common\models;


use yii\db\ActiveRecord;
use Ramsey\Uuid\Uuid;

class Category extends ActiveRecord
{
    public function createUUID()
    {
        return $this->uuid = (string)Uuid::uuid4();
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'trim']
        ];
    }
}