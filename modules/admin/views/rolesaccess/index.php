<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RolesAccessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles Accesses';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="roles-access-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Create Roles Access', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Fill up Roles', ['fillup'], ['class' => 'btn btn-warning']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                'role_access_id',
                [
                    'attribute' => 'role_id',
                    'value'     => function ($data) {
                        return \app\modules\admin\models\Roles::findOne($data->role_id)->name;
                    },
                    'filter'    => \common\components\Common::getRolesDropdown(),
                    //'format' => 'html'
                ],

                [
                    'attribute' => 'controller',
                    /*'value'     => function ($data) {
                        return \app\modules\admin\models\Roles::findOne($data->role_id)->role_id;
                    },*/
                    'filter'    => \common\components\Common::getControllersDropdown(),
                    //'format' => 'html'
                ],
                [
                    'attribute' => 'action',
                    /*'value'     => function ($data) {
                        return \app\modules\admin\models\Roles::findOne($data->role_id)->role_id;
                    },*/
                    'filter'    => \common\components\Common::getControllersActionsDropdown(),
                    //'format' => 'html'
                ],
                [
                    'attribute' => 'allow',
                    'format'    => 'raw',
                    'value'     => function ($model, $index, $widget) {
                        return Html::checkbox('allow[]', $model->allow, ['value' => $index, 'class' => 'allowthisaction']);
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
<?php
$script = <<< JS
$(".allowthisaction").change(function(){
   
    var role_access_id = $(this).parents('tr').attr('data-key');  
     $.ajax({
        url: 'checkit',
        data: {role_access_id: role_access_id, 'checked':($(this).is(":checked") ? 1 : 0)},
        success: function(data) {
            // process data
            $('#favorites_count').html(data.favorites_count);
        }
    });
    
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);