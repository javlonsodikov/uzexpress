<?php

namespace app\controllers;

use app\models\FavoriteProducts;
use app\models\Products;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\web\Response;

class WishesController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $query = Products::find()->where('product_id in (select product_id from favorite_products where user_id=:user_id)',
            [':user_id' => Yii::$app->user->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 30]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', ['models' => $models, 'pages' => $pages]);
    }

    public function actionAddtowishlist($product_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (($model = Products::findOne($product_id)) !== null) {
            $favoriteProducts = FavoriteProducts::find()->where('product_id=:product_id and user_id=:user_id',
                [':product_id' => $product_id, ':user_id' => Yii::$app->user->id])->one();
            if ($favoriteProducts == null) {
                $favoriteProducts = new FavoriteProducts();
                $favoriteProducts->product_id = $model->product_id;
                $favoriteProducts->user_id = Yii::$app->user->id;
                $favoriteProducts->save();
                $user = User::findOne(Yii::$app->user->id);
                $user->favorites_count++;
                if ($user->save()) {
                    return ['success'         => 'Product added to wish list',
                            'error'           => false,
                            'favorites_count' => $user->favorites_count];
                } else {
                    return ['error' => $user->errors];
                }
            } else {
                return ['error' => 'Product already added'];
            }

        } else {
            return ['error' => 'Product not found'];
        }
    }

    public function actionRemovefromwishlist($product_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (($model = FavoriteProducts::find()->where('product_id=:product_id and user_id=:user_id',
                [':product_id' => $product_id, ':user_id' => Yii::$app->user->id])->one()) !== null
        ) {
            $model->delete();
            $user = User::findOne(Yii::$app->user->id);
            if ($user->favorites_count > 0) {
                $user->favorites_count--;
            }
            if ($user->save()) {
                return ['success'         => 'Product removed from wish list',
                        'error'           => false,
                        'favorites_count' => $user->favorites_count];
            }

        } else {
            return ['error' => 'Product not found'];
        }
    }
}
