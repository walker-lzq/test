<?php
/**
 * Created by PhpStorm.
 * Author: walker
 * Date: 2022/6/8
 * Time: 23:31
 */
declare(strict_types=1);


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */

$this->title                   = Yii::t('app', '创建供应商');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>