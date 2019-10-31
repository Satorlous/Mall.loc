<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property int $good_id
 * @property int $req_count
 * @property int $created_at
 * @property int $updated_at
 * @property bool $status
 * @property int $current_count
 * @property int $org_id
 * @property int $price
 * @property string $description
 *
 * @property Good $good
 * @property User $org
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => false],
            ['current_count', 'default', 'value' => 0],
            [['created_at', 'updated_at'], 'default', 'value' => time()],
            ['description', 'string', 'max' => 255],
            ['price', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'good_id' => 'Good ID',
            'req_count' => 'Req Count',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'current_count' => 'Current Count',
            'org_id' => 'Org ID',
            'price' => 'Price',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGood()
    {
        return $this->hasOne(Good::class, ['id' => 'good_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(User::class, ['id' => 'org_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartItem()
    {
        return $this->hasOne(CartItem::class, ['product_id' => 'id'])->where(['user_id' => Yii::$app->user->id]);
    }
}
