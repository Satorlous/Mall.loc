<?php

namespace frontend\controllers;

use frontend\models\Catalog;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
//        $catalog = new Catalog();
//        $catalog->good_id = 2;
//        $catalog->req_count = 3;
//        $catalog->status = true;
//        $catalog->created_at = time();
//        $catalog->updated_at = time();
//        $catalog->save();
    }
}
