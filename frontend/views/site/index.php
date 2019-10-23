<?php

/* @var $this yii\web\View */

$this->title = 'СП-Магазин';

use yii\helpers\Url;
use yii\widgets\LinkPager; ?>

<div class="site-index">
    <div class="body-content">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
        <ul id="goods" class="list-unstyled">
            <? foreach ($goods as $good): ?>
            <li class="good-item row">
                <div class="col-md-4">
                    <img class="good-item__img" alt="" src="<?=Yii::getAlias('@web/img/').$good->image?>">
                </div>
                <div class="col-md-8">
                    <div class="good-item__name"><?=$good->name?></div>
                    <div class="good-item__description"><?=$good->description?></div>
                    <div class="good-item__price"><?=$good->price?> руб.</div>
                    <button class="good-item__btn-add btn btn-success" data-id="<?=$good->id?>" data-name="<?=$good->name?>" data-price="<?=$good->price?>">Добавить в корзину</button>
                    <a href="<?= Url::toRoute(['site/products', 'id' => $good->id]) ?>"><button class="good-item__btn-add btn btn-info">Посмотреть</button></a>
                </div>
            </li>
            <? endforeach; ?>

        </ul>
    </div>
</div>
