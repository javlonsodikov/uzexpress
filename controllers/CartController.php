<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Products;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\Response;

class CartController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $queryDB = new Query();
        $query = $queryDB->select('products.*, cart.quantity')->
        from('cart')->
        join('join', 'products', 'products.product_id=cart.product_id')->
        where('cart.user_id=:user_id', [':user_id' => Yii::$app->user->id]);

        $queryClone = clone $query;
        $pages = new Pagination(['totalCount' => $queryClone->count(), 'pageSize' => 30]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', ['models' => $models, 'pages' => $pages]);
    }

    public function actionAddtocart($product_id, $quantity = 1)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (($model = Products::findOne($product_id)) !== null) {
            $cart = Cart::find()->where('product_id=:product_id and user_id=:user_id',
                [':product_id' => $product_id, 'user_id' => Yii::$app->user->id])->one();
            if ($cart == null) {
                $cart = new Cart();
                $cart->product_id = $model->product_id;
                $cart->user_id = Yii::$app->user->id;
            }
            $cart->quantity += $quantity;
            $cart->save();
            $user = User::findOne(Yii::$app->user->id);
            if ($user->incart_count < 0) {
                $user->incart_count = 0;
            }
            $user->incart_count++;
            if ($user->save()) {
                return ['success'      => 'Product added to cart',
                        'error'        => false,
                        'incart_count' => $user->incart_count];
            }
            return ['error' => $user->errors];

        } else {
            return ['error' => 'Product not found'];
        }
    }


    public function actionRemovefromcart($product_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (($model = Cart::find()->where('product_id=:product_id and user_id=:user_id',
                [':product_id' => $product_id, ':user_id' => Yii::$app->user->id])->one()) !== null
        ) {
            $user = User::findOne(Yii::$app->user->id);
            if ($user->incart_count > 0) {
                $user->incart_count--;
            }
            if ($user->incart_count < 0) {
                $user->incart_count = 0;
            }
            $model->delete();
            if ($user->save()) {
                return ['success'      => 'Product removed from cart',
                        'error'        => false,
                        'incart_count' => $user->incart_count];
            } else {
                return ['error' => $user->errors];
            }
        } else {
            return ['error' => 'Product not found'];
        }
    }


}
