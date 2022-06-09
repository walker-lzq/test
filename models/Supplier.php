<?php
/**
 * Created by PhpStorm.
 * Author: walker
 * Date: 2022/6/8
 * Time: 19:31
 */
declare(strict_types=1);


namespace app\models;


use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{
    
    public function rules()
    {
        return [
            [['id', 'name', 'code', 't_status'], 'trim'],
            ['id', 'integer'],
            [['name', 'code'], 'string'],
        ];
    }
    
    public static function tableName()
    {
        return 'supplier';
    }
    
    /**
     * @desc 导出
     * @param array $ids
     * @param array $columns
     * @return array|ActiveRecord[]
     */
    /**
     * @param array $ids
     * @param array $columns
     * @return array|ActiveRecord[]
     */
    public static function export(array $ids, array $columns)
    {
        return self::find()
            ->where(['id' => $ids])
            ->select($columns)
            ->asArray()
            ->all();
    }
}