<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $cart_id
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $quantity
 * @property string $added
 *
 * @property Products $product
 * @property User $user
 */
class Cart extends \yii\db\ActiveRecord
{
    const CART_PRODUCT_CANCELLED = -1;
    const CART_PRODUCT_ADDED = 1;
    const CART_PRODUCT_PAYED = 2;
    const CART_PRODUCT_SHIPPED = 3;
    const CART_PRODUCT_DELIVERED = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id'], 'required'],
            [['product_id', 'user_id', 'quantity', 'status'], 'integer'],
            [['added'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'product_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_id'    => 'Cart ID',
            'product_id' => 'Product ID',
            'user_id'    => 'User ID',
            'quantity'   => 'Quantity',
            'added'      => 'Added',
            'status'     => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
