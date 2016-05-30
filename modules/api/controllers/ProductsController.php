<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use yii\rest\UrlRule;
 
class ProductsController extends ActiveController
{
    public $modelClass = 'app\models\Products';
}
