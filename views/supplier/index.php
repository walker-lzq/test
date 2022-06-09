<?php

use yii\grid\CheckboxColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', '供应商');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="supplier-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a(Yii::t('app', '创建供应商'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    
    <?php echo $this->render('_search', ['model' => $searchModel, 'params' => $params]); ?>
    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'           => 'grid',
        'columns'      => [
            [
                'class' => CheckboxColumn::class,
            
            ],
            ['class' => SerialColumn::class],
            
            [
                'attribute' => 'id',
                'label'     => 'id',
            ],
            [
                'attribute' => 'name',
                'label'     => '名称',
            ],
            [
                'attribute' => 'code',
                'label'     => 'code',
            ],
            
            [
                'attribute' => 't_status',
                'label'     => '状态',
                
                'format' => 'raw',
                'value'  => static function ($data) {
                    return ($data->t_status === 'ok') ? '通过' : '等待审核';
                },
            ],
        
        ],
    ]);
    ?>


</div>


<div id="dx" style="display: none;margin: 10px;">
    
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="column1" value="id" checked disabled />id
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input column" name="column" value="name" />名称
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input column" name="column" value="code" />code
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input column" name="column" value="t_status" />状态
        </label>
    </div>
    <button type="button" id="download" class="btn btn-success" style="margin-top: 20px">导出</button>
</div>
<script type="text/javascript" src="https://www.layuicdn.com/layui/layui.js"></script>
<link rel="stylesheet" href="https://www.layuicdn.com/layui/css/layui.css">
<?php

$downloadUrl = \yii\helpers\Url::to(['export']);
$this->registerJs("
        $('#export').on('click', function () {
var keys = $('#grid').yiiGridView('getSelectedRows');
    if (0 == keys.length) {
         layer.msg('请选择');
        return;
    }
    layer.open({
      type: 1,
      title:'导出选择',
      content: $('#dx'),
      cancel: function(index, layerno) {
           $('#dx').hide();
      }
    });
    return;
});

$('#download').on('click', function() {
    var ids = [];
    $.each($('input[name=\'selection[]\']:checked'), function() {
        ids.push($(this).val());
    })
    var column = ['id'];
     $.each($('#dx .column:checked'), function() {
        column.push($(this).val())
     });
     window.open('{$downloadUrl}&ids=' + ids.join(',') + '&column=' + column.join(','));
});

$('.select-on-check-all').on('click', function () {
        if (true == $('.select-on-check-all').is(':checked')) {
            layui.use('layer', function () {
                var layer = layui.layer;
                layer.msg('您选择了本页所有的供应商，可点击取消全选取消');
                $('#cancle').show();
                $('#export').show();
            })
        } else {
            $('#export').hide();
            $('#cancle').hide();
        }
    })
    
    $('#cancle').on('click', function() {
        $('.select-on-check-all').click();
    });
    
    $('input[name=\'selection[]\']').on('click', function () {
        var status = false;
        $.each($('input[name=\'selection[]\']'), function () {
            if (false === status && this.checked) {
                status = true;
            }
        });
          if (status) {
            $('#export').show();
             $('#cancle').hide();
        } else {
            $('#export').hide();
            $('#cancle').hide();
        }
        
        setTimeout(function () {
            if (true == $('.select-on-check-all').is(':checked')) {
                layui.use('layer', function () {
                    var layer = layui.layer;
                    $('#cancle').show();
                    layer.msg('您选择了本页所有的供应商，可点击取消全选取消');
                });
            }
        }, 200);
     
    });


");
?>

<script>

</script>
