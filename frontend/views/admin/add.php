<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Catalog */
/* @var $good frontend\models\Good */
/* @var $form ActiveForm */
?>
<div class="admin-add">
    <h2><?=$good->name?></h2>
    <?=Html::img('@web/img/'.$good->image, ['height' => 300, ])?>
    <?php
        $form = ActiveForm::begin();
        $model->price = $good->price;
        $model->description = $good->description;
    ?>
        <?= $form->field($model, 'req_count')->label('Необходимое количество заказов') ?>
        <?= $form->field($model, 'price')->label('Цена') ?>
        <?= $form->field($model, 'description')->label('Описание товара') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-add -->
