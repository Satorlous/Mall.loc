<?
/* @var $product frontend\models\Catalog */
?>
<div class="good-item row">
    <div class="col-md-4">
        <img class="good-item__img" alt="" src="<?=Yii::getAlias('@web/img/').$product->good->image?>">
    </div>
    <div class="col-md-8">
        <div class="good-item__name"><span class="good-item__span">Товар:</span> <?=$product->good->name?></div>
        <div class="good-item__description"><span class="good-item__span">Описание товара:</span> <?=$product->good->description?></div>
        <div class="good-item__price"><span class="good-item__span">Цена:</span> <?=$product->good->price?> руб.</div>
        <? if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->admin):?>
            <?if($product->good->getCartItem()->count() == 0):?>
                <button class="good-item__btn-add btn btn-success" data-id="<?=$product->good->id?>" id="prod-<?=$product->good->id?>" onclick="AddItem(<?=$product->good->id?>)">Добавить в корзину</button>
            <? elseif($product->good->getCartItem()->count() > 0 && !$product->good->cartItem->ordered):?>
                <button class="good-item__btn-delete btn btn-danger" data-id="<?=$product->good->id?>" id="prod-<?=$product->good->id?>" onclick="RemoveItem(<?=$product->good->id?>)">Удалить из корзины</button>
            <? endif;?>
        <? endif;?>
    </div>
</div>
