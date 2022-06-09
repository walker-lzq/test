<?php
/**
 * Created by PhpStorm.
 * Author: walker
 * Date: 2022/6/8
 * Time: 19:27
 */

namespace app\controllers;

use app\models\Supplier;
use app\models\SupplierSearch;
use m35\thecsv\theCsv;
use yii\web\Controller;

/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller
{
    
    /**
     * @action 列表
     * @return string
     */
    public function actionIndex()
    {
        $params       = $this->request->queryParams;
        $searchModel  = new SupplierSearch();
        $dataProvider = $searchModel->search($params);
        
        
        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'params'       => $params,
        ]);
    }
    
    
    /**
     * @action 导出
     * @return void|\yii\web\Response
     * @throws \yii\web\HttpException
     */
    public function actionExport()
    {
        $params = \Yii::$app->request->get();
        if (empty($params['ids']) || empty($params['column'])) {
            return $this->goBack();
        }
        $ids    = explode(',', $params['ids']);
        $column = explode(',', $params['column']);
        $rows   = Supplier::export($ids, $column);
    
        $columns = [
            'id'       => '编号id',
            'name'     => '名称',
            'code'     => '代号',
            't_status' => '状态',
        ];
        if (!in_array('name', $column, true)) {
            unset($columns['name']);
        }
        if (!in_array('code', $column, true)) {
            unset($columns['code']);
        }
        if (!in_array('t_status', $column, true)) {
            unset($columns['t_status']);
        }
        theCsv::export([
            'data'   => $rows,
            'header' => $columns,
        ]);
    }
    
    /**
     * @action 创建
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Supplier();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
