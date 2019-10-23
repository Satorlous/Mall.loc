<div class="good-item row">
    <div class="col-md-4">
        <img class="good-item__img" alt="" src="<?=Yii::getAlias('@web/img/').$product->image?>">
    </div>
    <div class="col-md-8">
        <div class="good-item__name"><span class="good-item__span">Товар:</span> <?=$product->name?></div>
        <div class="good-item__description"><span class="good-item__span">Описание товара:</span> <?=$product->description?></div>
        <div class="good-item__price"><span class="good-item__span">Цена:</span> <?=$product->price?> руб.</div>
        <button class="good-item__btn-add btn btn-success" data-id="<?=$product->id?>" data-name="<?=$product->name?>" data-price="<?=$product->price?>">Добавить в корзину</button>
    </div>
</div>
