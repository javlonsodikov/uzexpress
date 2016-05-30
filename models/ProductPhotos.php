<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_photos".
 *
 * @property integer $product_photo_id
 * @property integer $product_id
 * @property string $product_photo_name
 *
 * @property Products $product
 */
class ProductPhotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_photo_name'], 'required'],
            [['product_id'], 'integer'],
            [['product_photo_name'], 'string', 'max' => 1024],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_photo_id' => 'Product Photo ID',
            'product_id' => 'Product ID',
            'product_photo_name' => 'Product Photo Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['product_id' => 'product_id']);
    }
}
