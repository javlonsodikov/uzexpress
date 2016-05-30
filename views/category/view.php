<?php
/* @var $this yii\web\View */
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<h1><?= $category->category_name ?></h1>

<p>
    <?php

    foreach ($models as $model) {
        echo $this->render('../products/_product_item', [
            'model' => $model,
        ]);
    }
    echo "<div style='clear:both'></div>";

    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</p>
