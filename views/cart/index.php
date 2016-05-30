<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;


$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>My cart</h1>
    <div class="cart-index">
        <?php
        if ($models) {
            foreach ($models as $model) {
                echo $this->render('../cart/_product_cart_item', [
                    'model' => $model,
                ]);
            }
            echo "<div style='clear:both'></div>";

            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
        }
        ?>
    </div>
<?php
$script = <<< JS
$('.removefromcart').on('click', function(e) {
if (confirm("Do you really want to delete this product from your cart?")){
    var product_id=$(this).attr('product_id');
    var that = $(this);
    $.ajax({
        url: '/cart/removefromcart',
        data: {product_id: product_id, '_csrf': $('head meta[name="csrf-token"]').attr("content")},
        success: function(data) {
            if (data.error!=false){
                alert(data.error);
            }
            else {
                $('#incart_count').html(data.incart_count);
                $(that).parents(".row[rel=" + product_id + "]").remove();
            }
        }
        
    });
    }
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);