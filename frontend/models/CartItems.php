<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cart_items".
 *
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property bool $ordered
 */
class CartItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'quantity'], 'required'],
            [['user_id', 'product_id', 'quantity'], 'default', 'value' => null],
            [['user_id', 'product_id', 'quantity'], 'integer'],
            [['ordered'], 'boolean'],
            [['ordered'], 'default', 'value' => true],
            [['user_id', 'product_id'], 'unique', 'targetAttribute' => ['user_id', 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'ordered' => 'Ordered',
        ];
    }
}
