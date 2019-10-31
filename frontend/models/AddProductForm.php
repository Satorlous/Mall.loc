<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * AddProduct Form
 */

class AddProductForm extends Model
{
    public $good_id;
    public $org_id;
    public $req_count;
    public $price;
    public $description;
    //auto-values
    public $created_at;
    public $updated_at;
    public $status;
    public $current_count;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['req_count', 'price', 'description'], 'required', 'message' => 'Заполните поле'],
            ['price', 'integer', 'message' => 'Цена может быть только целым числом'],
            ['req_count', 'integer', 'message' => 'Количество может быть только целым числом'],
            ['description', 'string', 'max' => 255],
        ];
    }

    public function add()
    {
        if (!$this->validate()) {
            return null;
        }

        $p = new Catalog();
        $p->good_id = $this->good_id;
        $p->org_id = Yii::$app->user->getId();
        $p->req_count = $this->req_count;
        $p->price = $this->price;
        $p->description = $this->description;
        return $p->save();
    }


}
