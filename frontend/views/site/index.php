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
                    <div class="good-item__description"><?=$item->good->description?></div>
                    <div class="good-item__price"><?=$item->good->price?> руб.</div>
                    <div class="form-group" style="margin-top: 10px">
                        <label for="count-<?=$item->good->id?>" class="col-2" style="font-weight: normal;">Количество:</label>
                        <div class="col-10">
                            <input type="number" id="count-<?=$item->good->id?>" class="form-control d-inline-block" min="1" max="100" value="<?= $item->good->cartItem->quantity == null ? 1 : $item->good->cartItem->quantity?>">
                        </div>
                    <? if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->admin):?>
                        <?if($item->good->getCartItem()->count() == 0):?>
                            <button class="good-item__btn-add btn btn-success" data-id="<?=$item->good->id?>" id="prod-<?=$item->good->id?>" onclick="AddItem(<?=$item->good->id?>)">Добавить в корзину</button>
                        <? elseif($item->good->getCartItem()->count() > 0 && !$item->good->cartItem->ordered):?>
                            <button class="good-item__btn-delete btn btn-danger" data-id="<?=$item->good->id?>" id="prod-<?=$item->good->id?>" onclick="RemoveItem(<?=$item->good->id?>)">Удалить из корзины</button>
                        <? endif;?>
                    <? endif;?>
                    <a href="<?= Url::toRoute(['site/products', 'id' => $item->good->id]) ?>"><button class="btn btn-info" style="margin-top: 30px;">Посмотреть</button></a>

                </div>
            </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>
