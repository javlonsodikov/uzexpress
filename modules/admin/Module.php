<?php

namespace app\modules\admin;

use app\modules\admin\models\RolesAccess;
use Yii;
use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'         => true,
                        'matchCallback' => function ($rule, $action) {
                            $res = RolesAccess::find()->where("role_id=:role_id and controller=:controller and action=:action",
                                [
                                    ':role_id'    => Yii::$app->user->identity->role,
                                    ':controller' => $action->controller->id . 'Controller',
                                    ':action'     => $action->id,
                                ])->one();
//                            return true;
                            return $res['allow'];

                        }
                    ]
                ],
            ],
        ];
    }
}
