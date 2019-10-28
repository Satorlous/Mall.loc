<?php

/* @var $this yii\web\View */
/* @var $pages yii\data\Pagination */
/* @var $goods frontend\models\Good */

$this->title = 'СП-Магазин';

use yii\helpers\Url;
use yii\widgets\LinkPager;?>

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
                    <div style="margin-top: 5px">Статус:
                        <? if($good->status):?>
                            <span class="good-item__status-open">ОТКРЫТА
                        <? else:?>
                            <span class="good-item__status-closed">ЗАКРЫТА
                        <? endif;?>
                        </span>
                    </div>
                    <? if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->admin):?>
                        <?if($good->getCartItems()->count() == 0):?>
                            <button class="good-item__btn-add btn btn-success" data-id="<?=$good->id?>" id="prod-<?=$good->id?>" onclick="AddItem(<?=$good->id?>)">Добавить в корзину</button>
                        <? elseif($good->getCartItems()->count() > 0):?>
                            <button class="good-item__btn-delete btn btn-danger" data-id="<?=$good->id?>" id="prod-<?=$good->id?>" onclick="RemoveItem(<?=$good->id?>)">Удалить из корзины</button>
                        <? endif;?>
                    <? endif;?>
                    <a href="<?= Url::toRoute(['site/products', 'id' => $good->id]) ?>"><button class="btn btn-info" style="margin-top: 30px;">Посмотреть</button></a>

                </div>
            </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>
