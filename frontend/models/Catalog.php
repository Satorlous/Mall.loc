<?php

namespace frontend\models;

use frontend\models\Good;
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
 *
 * @property Good $good
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
            [['good_id', 'req_count', 'created_at', 'updated_at'], 'required'],
            [['good_id', 'req_count', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['good_id', 'req_count', 'created_at', 'updated_at'], 'integer'],
            [['status'], 'boolean'],
            [['status'], 'default', 'value' => false],
            [['good_id'], 'exist', 'skipOnError' => true, 'targetClass' => Good::className(), 'targetAttribute' => ['good_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGood()
    {
        return $this->hasOne(Good::className(), ['id' => 'good_id']);
    }
}
