<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-search">
    
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <label class="control-label" for="suppliersearch-id">Id符号</label>
                <?php $idSymbol = $params['SupplierSearch']['idSymbol'] ?? ''; ?>
                <select type="text" class="form-control" name="SupplierSearch[idSymbol]">
                    <option value="=" <?= $idSymbol === '=' ? 'selected' : '' ?>>=</option>
                    <option value=">" <?= $idSymbol === '>' ? 'selected' : '' ?>>></option>
                    <option value="<" <?= $idSymbol === '<' ? 'selected' : '' ?>><</option>
                    <option value=">=" <?= $idSymbol === '>=' ? 'selected' : '' ?>>>=</option>
                    <option value="<=" <?= $idSymbol === '<=' ? 'selected' : '' ?>><=</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="control-label" for="suppliersearch-id">Id</label>
                <input type="text" id="suppliersearch-id" class="form-control" name="SupplierSearch[id]" value="<?= $params['SupplierSearch']['id'] ?? '' ?>">
            
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'name') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'code') ?>
            </div>
            <div class="col-md-2">
                
                <div class="form-group field-suppliersearch-t_status">
                    <?php $tStatus = $params['SupplierSearch']['t_status'] ?? ''; ?>
                    <label class="control-label" for="suppliersearch-t_status">状态</label>
                    <select type="text" class="form-control" name="SupplierSearch[t_status]">
                        <option value="">全部</option>
                        <option value="ok" <?= $tStatus === 'ok' ? 'selected' : '' ?>>通过</option>
                        <option value="hold" <?= $tStatus === 'hold' ? 'selected' : '' ?>>待审核</option>
                    </select>
                </div>
            </div>
        </div>
    
    </div>
    
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', '重置'), ['class' => 'btn btn-outline-secondary cancel-search']) ?>
        
        <button class="btn btn-primary" id="export" type="button" style="display: none"> 导出</button>
        <button class="btn btn-danger" id="cancle" type="button" style="display: none"> 取消全选</button>
    
    </div>
    
    <?php ActiveForm::end(); ?>

</div>





<?php
$url = \yii\helpers\Url::to(['index']);
$this->registerJs("
        $('.cancel-search').on('click', function () {
        window.location.href = '{$url}';
});
");
?>


