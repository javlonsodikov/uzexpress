<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;


$this->title = 'Wishes';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>My wishes</h1>
    <div class="wish-index">
        <?php
        if ($models) {
            foreach ($models as $model) {
                echo $this->render('../wishes/_product_wish_item', [
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
$('.removefromwishes').on('click', function(e) {
if (confirm("Do you really want to delete this product from your wish list?")){
    var product_id=$(this).attr('product_id');
    var that = $(this);
    $.ajax({
        url: '/wishes/removefromwishlist',
        data: {product_id: '$model->product_id', '_csrf': $('head meta[name="csrf-token"]').attr("content")},
        success: function(data) {
            if (data.error!=false){
                alert(data.error);
            }
            else {
                $('#favorites_count').html(data.favorites_count);
                $(that).parents(".row[rel=" + product_id + "]").remove();
            }
        }
    });
    }
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);