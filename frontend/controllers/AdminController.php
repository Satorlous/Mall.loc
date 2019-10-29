<?php

namespace frontend\controllers;

use frontend\models\Catalog;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class AdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->admin;
                        },
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    if(!Yii::$app->user->identity->admin){
                        $this->redirect('/site/index');
                    }
                },
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        $catalog = new Catalog();
        $catalog->good_id = 1;
        $catalog->req_count = 3;
        $catalog->status = true;
        $catalog->created_at = time();
        $catalog->updated_at = time();
        $catalog->save();
    }
}
