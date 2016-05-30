<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Products */

$this->title = 'Update Products: ' . $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'  => $model,
        'photos' => $photos
    ]) ?>

</div>

<?php
$script = <<< JS
$(function(){
       $(".deletebtn").click(function(){
            if (confirm('Do you really want to delete this photo?'))
            {
                var that = $(this);
                var imgname= $(this).attr("rel");
                 $.ajax({
                     url: 'deletephoto', 
                     data: {product_photo_id: imgname, '_csrf': $('head meta[name="csrf-token"]').attr("content")},
                    success: function(data) {
                        // process data
                        $(that).parents('.image-holder').remove();
                        var numeration=1;
                        $('.image-holder').each(function(){
                            $('.numuration',this).html(numeration++);
                        });
                    }
                });
            }
       });   
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);



