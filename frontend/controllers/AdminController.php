<?php

namespace frontend\controllers;

use frontend\models\AddProductForm;
use frontend\models\Catalog;
use frontend\models\Good;
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
        $goods = Good::find()->all();
        return $this->render('index', compact('goods'));
    }

    public function actionAdd($id)
    {
        if(Catalog::find()->where(['good_id' => $id, 'org_id' => Yii::$app->user->id])->count() != 0)
        {
            Yii::$app->session->setFlash('error', 'Этот товар уже добавлен в закупку');
            return $this->redirect(Url::toRoute('admin/index'));
        }
        $good = Good::findOne($id);
        $model = new AddProductForm();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->good_id = $good->id;
            if($model->add())
            {
                Yii::$app->session->setFlash('success', 'Товар успешно добавлен.');
                return $this->redirect(Url::toRoute('admin/index'));
            }
        }
        return $this->render('add', [
            'model' => $model,
            'good' => $good,
        ]);
    }

    public function actionAdded()
    {
        $items = Catalog::find()->where(['org_id' => Yii::$app->user->id])->all();
        return $this->render('added', compact('items'));
    }

    public function actionChangeStatus()
    {
        $id = Yii::$app->request->post('id');
        $item = Catalog::findOne($id);
        $item->status = !$item->status;
        if ($item->save())
            return 'Добавлено';
        return 'Ошибка';
    }
}
