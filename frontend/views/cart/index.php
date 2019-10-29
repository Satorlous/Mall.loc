<?php
/* @var $this yii\web\View */
/* @var $cart \devanych\cart\Cart */
/* @var $item \devanych\cart\CartItem */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if(!empty($cartItems = $cart->getItems())): ?>
        <table class="table cart-table">
            <thead>
            <tr class="active">
                <th>Фото</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Количество</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cartItems as $item): ?>
            <? $item_cat = $item->getProduct()->catalogItem; ?>
                <tr style="vertical-align: middle">
                    <td><?=Html::img("@web/img/{$item->getProduct()->image}", ['alt' => $item->getProduct()->name, 'width' => 50])?></td>
                    <td><a href="<?=Url::to('@web/products/' . $item->getProduct()->id)?>"><?= $item->getProduct()->name ?></a></td>
                    <td><?=$item->getPrice()?> руб.</td>
                    <td><?=$item->getQuantity()?></td>
                    <?if(!$item->getProduct()->cartItem->ordered): ?>
                        <td><a class="btn btn-danger btn-sm" href="<?=Url::to(['cart/remove', 'id' => $item->getId()])?>">Удалить</a></td>
                        <? if($item_cat->status): ?>
                            <td><a href="<?=Url::to(['cart/order', 'id' => $item->getId(), 'qty' => $item->getQuantity()])?>" class="btn btn-success btn-sm">Заказать</a></td>
                        <? endif;?>
                    <? endif;?>
                    <? if($item->getProduct()->cartItem->ordered && $item_cat->current_count < $item_cat->req_count ): ?>
                        <td></td><td><div class="btn btn-info btn-sm disabled">Ожидание</div></td>
                    <? elseif($item->getProduct()->cartItem->ordered && $item_cat->current_count >= $item_cat->req_count ): ?>
                        <td></td><td><a href="<?=Url::to()?>" class="btn btn-success btn-sm">Оплатить</a></td>
                    <? endif; ?>

                </tr>
            <?php endforeach; ?>
            <tr class="info">
                <td colspan="3">Общее кол-во:</td>
                <td colspan="3"><?= $cart->getTotalCount()?></td>
            </tr>
            <tr class="success">
                <td colspan="3">Общая сумма:</td>
                <td colspan="3"><?=$cart->getTotalCost()?> руб.</td>
            </tr>
            </tbody>
        </table>
<?php else:?>
    <h3>Корзина пуста</h3>
<?php endif;?>