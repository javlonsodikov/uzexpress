<?php

namespace app\modules\admin\controllers;

use app\models\ProductPhotos;
use app\models\Products;
use app\modules\admin\models\ProductsSearch;
use app\modules\admin\models\UrlGrabber;
use common\components\Common;
use Yii;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{


    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            /*$product_photo = UploadedFile::getInstance($model, 'product_photo');
            $model->product_photo = Common::$PRODUCT_PHOTO_URL . time() . '.' . $product_photo->extension;
            //$model->product_photo = time() . '.' . $product_photo->extension;
            $product_photo->saveAs($model->product_photo);*/
            $model->save();
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            $photos = ProductPhotos::find()->where('product_id=:product_id', [':product_id' => $id])->all();
            return $this->render('update', [
                'model'  => $model,
                'photos' => $photos
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRealDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Marks an existing Products model as deleted.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->product_state = Products::PRODUCT_DELETED;
        $model->save(false);
        return $this->redirect(['index']);
    }

    public function actionFillup()
    {
        $model = new UrlGrabber();
        if ($model->load(Yii::$app->request->post())) {
            Common::aliExpress($model);
            Yii::$app->session->setFlash('success', "Data imported!");
            return $this->render('fillup', [
                'model' => $model,
            ]);
        } else {
            return $this->render('fillup', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatepost()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Products();
        $model->product_name = 'New Product';
        $model->product_price = 0;
        $model->product_category_id = 1;
        $model->product_state = 1;
        $model->save(false);
        return ['product_id' => $model->product_id];
    }

    public function actionUpload($product_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (($model = $this::findModel($product_id)) != null) {

            $photo = UploadedFile::getInstance($model, 'product_photo');
            $base_name = time() . $photo->baseName . '.' . $photo->extension;
            @mkdir(Common::PRODUCT_PHOTO_THUMB_URL, true);
            $product_photo_name = Common::PRODUCT_PHOTO_URL . $base_name;
            $product_photo_thumb_name = Common::PRODUCT_PHOTO_THUMB_URL . $base_name;
            $photo->saveAs($product_photo_name);
            Image::thumbnail($product_photo_name, Yii::$app->params['thumbImgWidth'], Yii::$app->params['thumbImgHeight'])->
                save($product_photo_thumb_name, ['quality' => 80]);
            $productPhotos = new ProductPhotos();
            $productPhotos->product_id = $product_id;
            $productPhotos->product_photo_name = $base_name;
            $productPhotos->save(false);
            return ['files' =>
                        [0 => [
                            'url'          => '/' . $product_photo_name,
                            'thumbnailUrl' => '/' . $product_photo_thumb_name,
                            'name'         => $base_name,
                            'type'         => $photo->type,
                            'size'         => $photo->size,
                            'deleteUrl'    => 'deletephoto/?product_photo_id=' . $productPhotos->product_photo_id,
                            'deleteType'   => 'Delete'
                        ]
                        ]
            ];
        }
    }

    public function actionDeletephoto($product_photo_id)
    {
        $productPhotos = ProductPhotos::findOne($product_photo_id);
        $base_name = $productPhotos->product_photo_name;
        $product_photo_name = Common::PRODUCT_PHOTO_URL . $base_name;
        $product_photo_thumb_name = Common::PRODUCT_PHOTO_THUMB_URL . $base_name;
        $productPhotos->delete();
        @unlink($product_photo_name);
        @unlink($product_photo_thumb_name);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ["$product_photo_name"       => true,
                "$product_photo_thumb_name" => true
        ];
    }
}
