<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;

class DefaultController extends ActiveController
{
    public $modelClass = 'app\models\User';
}
