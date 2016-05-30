<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">
    <?php
    if ($models) {
        foreach ($models as $model) {
            echo $this->render('../products/_product_item', [
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
