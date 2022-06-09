<?php
/**
 * Created by PhpStorm.
 * Author: walker
 * Date: 2022/6/8
 * Time: 22:32
 */
declare(strict_types=1);


namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;


class SupplierSearch extends Supplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'code', 't_status'], 'safe'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params) : ActiveDataProvider
    {
        $query = Supplier::find();
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        if ($this->id) {
            $query->andFilterWhere([$params['SupplierSearch']['idSymbol'], 'id', $this->id,]);
        }
        
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 't_status', $this->t_status]);
        
        return $dataProvider;
    }
}