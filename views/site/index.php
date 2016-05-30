<?php
use yii\bootstrap;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use common\components\Common;
/* @var $this yii\web\View */

$this->title = 'UzExpress main page';
?>

<div class="row">
    <div id="categories" class=" col-lg-3">
        <ul class="list-group">
            <? foreach (Common::getCategoryDropdownParents() as $categoryId => $categoryName) {
                echo '<li class="list-group-item "><a  href="category/view/' . $categoryId . '" rel="' . $categoryId . '">' . ($categoryName ? trim($categoryName) : 'All categories') . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <div id="main-products" class="col-lg-8">
        <?php
        $images = [];
        for ($img_number = 1; $img_number <= 8; $img_number++) {
            $images[] = '<img src="img/carousel/' . $img_number . '.jpg">';
        }
        echo bootstrap\Carousel::widget([
            'items' => $images
        ]);
        ?>
    </div>
</div>

<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?php
            $query = \app\models\Products::find();
            $countQuery =clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 30]);
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            foreach ($models as $product) {
                echo $this->render('../products/_product_item', [
                    'model' => $product,
                ]);
            }
            echo "<div style='clear:both'></div>";

            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
    </div>
</div>
