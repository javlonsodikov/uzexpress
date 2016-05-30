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
<div class="row" rel="<?= $model['product_id'] ?>">

    <div class="col-lg-3">

        <?php $img = '<img src="' . Common::imgThumb($model['product_photo']) . '">'; ?>
        <?= Html::a($img, ['products/view/' . $model['product_id']]); ?>

    </div>
    <div class="col-lg-5">
        <div><?= Html::a($model->product_name, ['products/view/' . $model['product_id']]); ?></div>
        <div><?= $model['product_description'] ?></div>
        <div> US $<?= $model['product_price'] ?></div>
        <p></p>
        <div> Quantity: <?= $model['quantity'] ?></div>
        <p></p>
        <p></p>
        <div><?= Html::a('Buy &raquo;', ['products/view/' . $model['product_id']], ['class' => 'btn btn-danger']) ?>
            <?= Html::button('Remove from cart',
                ['class' => 'btn btn-warning removefromcart', 'product_id' => $model['product_id']]) ?>
        </div>
    </div>


</div>
<br/>