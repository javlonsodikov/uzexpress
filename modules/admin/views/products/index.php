<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Fillup Products', ['fillup'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    Pjax::begin([
    // PJax options
    ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'attribute'=>'product_id',
                'contentOptions'=>['class'=>'grid-id-column'],
            ],
            ['class'         => 'yii\grid\DataColumn',
             'label'         => 'Title',
             'enableSorting' => true,
             'value'         =>
                 function ($data) {

                     return strlen($data->product_name) > 32 ? substr($data->product_name, 0, 32) . "..." : $data->product_name;
                 }],
            ['class'         => 'yii\grid\DataColumn',
             'enableSorting' => true,
             'label'         => 'Description',
             'format' => 'html',
             'value'         =>
                 function ($data) {
                     return strlen($data->product_description) > 64 ? substr($data->product_description, 0, 64) . "..." : $data->product_description;
                 }],
            'product_price',
            'product_category_id',
            // 'product_created_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    Pjax::end();
    ?>
</div>
