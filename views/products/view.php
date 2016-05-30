<?php

use common\components\Common;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="products-view">


        <div class="row">
            <div class="col-lg-3">
                <div class="product-thumbs-section">
                    <?php
                    foreach ($photos as $photo) {
                        echo Html::img(Common::imgThumb($photo->product_photo_name), ['class' => 'product-thumbs', 'rel' => $photo->product_photo_name]);
                    }
                    ?>
                </div>
                <div class="product-image"
                     rel="<?= $model->product_photo ?>"><?= Html::img(Common::imgThumb($model->product_photo)) ?></div>
                <div class="product-image-full"><img src=""></div>


            </div>
            <div class="col-lg-5">
                <p><?= $model->product_name; ?></p>
                <p>Price: US $<?= $model->product_price; ?></p>
                <p><?= $model->product_description; ?></p>
                <br/>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="input-group number-spinner">
				            <span class="input-group-btn">
					            <button class="btn btn-default" data-dir="dwn" onclick="quantity(-1);"><span
                                        class="glyphicon glyphicon-minus"></span>
                                </button>
				            </span>
                            <p><?= Html::input('text', 'quantity', '1', ['id' => 'quantity', 'class' => 'form-control text-center']) ?></p>
				            <span class="input-group-btn">
					            <button class="btn btn-default" data-dir="up" onclick="quantity(1);"><span
                                        class="glyphicon glyphicon-plus"></span>
                                </button>
				            </span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <?= Html::button('Add to cart', ['class' => 'btn btn-danger', 'id' => 'addtocart']) ?>
                    </div>


                </div>
                <br/> <br/>
                <div class="col-lg-4">
                    <?= Html::button('Add to wishlist', ['class' => 'btn btn-success', 'id' => 'addtowishlist']) ?>
                </div>
                <div class="col-lg-4">
                    <?= Html::button('Buy now', ['class' => 'btn btn-warning']) ?>
                </div>
            </div>
        </div>

    </div>
<?php
$thumb = Common::imgUrl("");
$script = <<< JS
$('#addtocart').on('click', function(e) {
    var quantity=parseInt($("#quantity").val());;
    $.ajax({
        url: '/cart/addtocart',
        data: {product_id: '$model->product_id', 'quantity': quantity, '_csrf': $('head meta[name="csrf-token"]').attr("content")},
        success: function(data) {
            $('#incart_count').html(data.incart_count);
        }
    });
});

$('#addtowishlist').on('click', function(e) {
    $.ajax({
        url: '/wishes/addtowishlist',
        data: {product_id: '$model->product_id', '_csrf': $('head meta[name="csrf-token"]').attr("content")},
        success: function(data) {
            // process data
            $('#favorites_count').html(data.favorites_count);
        }
    });
}); 
function quantity(count){
    var quantity_ =parseInt($("#quantity").val());
    quantity_+=count;
    if (quantity_<1) quantity_=1;
    $("#quantity").val(quantity_);
    

}
$(function() {
      $(".product-thumbs").hover(function(){
        var img=$(this).attr("rel");
        $(".product-image img").attr("src", "/uploads/products/thumbs/" + img);
        $(".product-image").attr("rel", img);
    });
     $(".product-image").hover(function(){
        $(".product-image-full img").attr('src','$thumb'+$(".product-image").attr('rel'));
        $(".product-image-full").show();
     },
     function() {
        $(".product-image-full").hide();
     }
     );
})
JS;
$this->registerJs($script, \yii\web\View::POS_END);


