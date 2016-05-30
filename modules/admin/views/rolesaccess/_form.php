<?php

use common\components\Common;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RolesAccess */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="roles-access-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-2">
            <?= $form->field($model, 'role_id')
                ->dropDownList(Common::getRolesDropdown(),
                    [
                        'class' => 'chosen-select input-md required',
                    ]
                )->label("Role"); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'action')
                ->dropDownList(Common::getControllersActionsDropdown(),
                    [
                        'class' => 'chosen-select input-md required',
                    ]
                )->label("Action"); ?>
            <?= $form->field($model, 'controller')->hiddenInput()->label(false); ?>
        </div>

        <div class="col-lg-2">
            <?= $form->field($model, 'allow')->checkbox() ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$script = <<< JS
$("#rolesaccess-action").change(function(){
 
    var selected = $("option:selected", this);
    $("#rolesaccess-controller").val(selected.parent().attr('label'));
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);