<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\Model;


/* @var $this yii\web\View */
/* @var $model common\models\Products */

$this->title = 'Fillup Products';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-fillup">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'category_id')
        ->dropDownList(\common\components\Common::getCategoryDropdown(),
            [
                'class' => 'chosen-select input-md required',
            ]
        )->label("Category"); ?>

    <div class="form-group">
        <?= Html::submitButton('Get products', ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
