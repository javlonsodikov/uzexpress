<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Products;
use yii\data\Pagination;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex($id = 0)
    {
        return $this->actionView($id);
    }

    public function actionView($id = 0)
    {
        $category = Categories::findOne($id);
        if ($category != null) {
            $query = Products::find()->where(["product_category_id" => $id]);
        } else {
            $query = Products::find();
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 30]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('view', ['models'   => $models,
                                      'pages'    => $pages,
                                      'category' => $category]);
    }

}
