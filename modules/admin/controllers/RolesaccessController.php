<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Roles;
use app\modules\admin\models\RolesAccess;
use app\modules\admin\models\RolesAccessSearch;
use common\components\Common;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * RolesaccessController implements the CRUD actions for RolesAccess model.
 */
class RolesaccessController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RolesAccess models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolesAccessSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RolesAccess model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the RolesAccess model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RolesAccess the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RolesAccess::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new RolesAccess model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RolesAccess();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->role_access_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RolesAccess model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->role_access_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RolesAccess model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCheckit($role_access_id, $checked)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = RolesAccess::findOne($role_access_id);
        $model->allow = $checked;
        $model->save();
    }

    public function actionFillup()
    {
        foreach (Roles::find()->all() as $role) {
            foreach (Common::getControllersActionsDropdown() as $key => $controller) {
                foreach ($controller as $action) {
                    $_roleaccess = new RolesAccess();
                    $_roleaccess->role_id = $role->role_id;
                    $_roleaccess->controller = $key;
                    $_roleaccess->action = $action;
                    $_roleaccess->allow = ($role->role_id == 1 ? 0 : 1);
                    try {

                        $_roleaccess->save();

                    } catch (\Exception $ex) {
                    }
                }
            }
        }
        return $this->redirect(['index']);
    }


}
