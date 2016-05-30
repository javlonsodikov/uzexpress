<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.05.2016
 * Time: 16:05
 */
use common\components\Common;
use yii\helpers\Html;

?>
<div class="col-lg-4">
    <?= Html::a($model->product_name, ['products/view/' . $model->product_id]); ?>

    <p>
        <?php $img = '<img src="' . Common::imgThumb($model->product_photo) . '">'; ?>
        <?= Html::a($img, ['products/view/' . $model->product_id]); ?>
    </p>
    <p> <?= $model->product_description ?></p>
    <p> US $<?= $model->product_price ?></p>


    <?= Html::a('Buy &raquo;', ['products/view/' . $model->product_id], ['class' => 'btn btn-default']) ?>

</div>
<br/>