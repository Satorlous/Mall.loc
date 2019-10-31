<?php

/* @var $this yii\web\View */
/* @var $pages yii\data\Pagination */
/* @var $catalog frontend\models\Catalog */

$this->title = 'СП-Магазин';

use yii\helpers\Url;
use yii\widgets\LinkPager;?>

<div class="site-index">
    <div class="body-content">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
        <ul id="goods" class="list-unstyled">
            <? foreach ($catalog as $item): ?>
            <li class="good-item row">
                <div class="col-md-4">
                    <img class="good-item__img" alt="" src="<?= Yii::getAlias('@web/img/').$item->good->image?>">
                </div>
                <div class="col-md-8">
                    <div class="good-item__name"><?=$item->good->name?></div>
                    <div class="good-item__description"><?=$item->description?></div>
                    <div class="good-item__price"><?=$item->price?> руб.</div>
                    <div class="form-group" style="margin-top: 10px">
                        <? if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->admin && $item->status): ?>
                        <label for="count-<?=$item->id?>" class="col-2" style="font-weight: normal;">Количество:</label>
                        <div class="col-10">
                            <input type="number" id="count-<?=$item->id?>" class="form-control d-inline-block" min="1" max="100" value="<?= $item->cartItem->quantity == null ? 1 : $item->cartItem->quantity?>">
                        </div>
                        <? endif; ?>
                    <? if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->admin && $item->status):?>
                        <?if(!isset($item->cartItem)) :?>
                            <button class="good-item__btn-add btn btn-success" id="prod-<?=$item->id?>" onclick="AddItem(<?=$item->id?>)">Добавить в корзину</button>
                        <? elseif(isset($item->cartItem) && !$item->cartItem->ordered):?>
                            <button class="good-item__btn-delete btn btn-danger" id="prod-<?=$item->id?>" onclick="RemoveItem(<?=$item->id?>)">Удалить из корзины</button>
                        <? endif;?>
                    <? endif;?>
                    <a href="<?= Url::toRoute(['site/products', 'id' => $item->id]) ?>"><button class="btn btn-info" style="margin-top: 30px;">Посмотреть</button></a>
                    <? if($item->cartItem->ordered): ?>
                        <button class="btn btn-success disabled" style="margin-top: 30px;">Товар заказан</button>
                        <? if ($item->current_count > $item->req_count) :?>
                            <button class="btn btn-primary disabled" style="margin-top: 30px;">Ожидает оплаты</button>
                        <? endif; ?>
                    <? endif; ?>

                </div>
            </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>
