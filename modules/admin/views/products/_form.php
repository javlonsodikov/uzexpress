<?php

use common\components\Common;
use dosamigos\ckeditor\CKEditor;
use limion\jqueryfileupload\JQueryFileUpload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

s

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 10],
        'preset'  => 'advanced'
    ]) ?>

    <?= $form->field($model, 'product_price')->textInput() ?>

    <?= $form->field($model, 'product_count')->textInput() ?>

    <?= $form->field($model, 'product_category_id')
        ->dropDownList(Common::getCategoryDropdown(),
            [
                'class' => 'chosen-select input-md required',
            ]
        )->label("Category"); ?>

    <?php
    if ($photos && is_array($photos)) {
        $numeration = 1;
        foreach ($photos as $photo) {
            echo '<div class="image-holder">';
            echo Html::img('/uploads/products/thumbs/' . $photo->product_photo_name);
            echo '<span class="numuration">' . ($numeration++) . '</span>';
            echo '<span class="delete-btn"><a href="javascript:void(0);" class="deletebtn" rel="' . $photo->product_photo_id . '">x</a></span>';
            echo '</div>';
        }
    }
    ?>
    <?= JQueryFileUpload::widget([
        'name'          => 'Products[product_photo]',
        'url'           => ['upload', 'product_id' => $model->product_id], // your route for saving images,
        'appearance'    => 'ui', // available values: 'ui','plus' or 'basic'
        'formId'        => $form->id,
        'options'       => [
            'accept' => 'image/*'
        ],
        'clientOptions' => [
            'maxFileSize'     => 8000000,
            'dataType'        => 'json',
            'acceptFileTypes' => new yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
            'autoUpload'      => false
        ]
    ]); ?>

    <img src="<?= Common::imgThumb($model->product_photo)  ?>" width="200" height="200">

    <?= $form->field($model, 'product_created_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
