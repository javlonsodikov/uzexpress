<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $product_id
 * @property string $product_name
 * @property string $product_photo
 * @property double $product_price
 * @property integer $product_category_id
 * @property integer $product_state
 * @property string $product_created_date
 */
class Products extends \yii\db\ActiveRecord
{
    const PRODUCT_PUBLISHED = 1;
    const PRODUCT_NOT_PUBLISHED = 0;
    const PRODUCT_DELETED = -1;

//    public $quantity;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name', 'product_price', 'product_category_id'], 'required'],
            [['product_price'], 'number'],
            [['product_description'], 'string'],
            [['product_photo'], 'string'],
            [['product_category_id'], 'integer'],
            [['product_state'], 'integer'],
            [['product_created_date'], 'safe'],
            [['product_name'], 'string', 'max' => 1024],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id'           => 'Product ID',
            'product_name'         => 'Product Name',
            'product_description'  => 'Product Description',
            'product_price'        => 'Product Price',
            'product_category_id'  => 'Product Category ID',
            'product_created_date' => 'Product Created Date',
        ];
    }
}
