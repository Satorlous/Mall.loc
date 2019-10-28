<?php
/* @var $this yii\web\View */
/* @var $cart \devanych\cart\Cart */
/* @var $item \devanych\cart\CartItem */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if(!empty($cartItems = $cart->getItems())): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="active">
                <th>Фото</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th></th>
                <th>Оплата</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cartItems as $item): ?>
                <tr>
                    <td><?=Html::img("@web/img/{$item->getProduct()->image}", ['alt' => $item->getProduct()->name, 'width' => 50])?></td>
                    <td><a href="<?=Url::to('@web/products/' . $item->getProduct()->id)?>"><?= $item->getProduct()->name ?></a></td>
                    <td><?=$item->getPrice()?></td>
                    <td><a href="<?=Url::to(['cart/remove', 'id' => $item->getId()])?>">Удалить</a></td>
                    <td><a href="<?=Url::to()?>" class="btn btn-success btn-sm">Оплатить</a></td>
                </tr>
            <?php endforeach; ?>
            <tr class="info">
                <td colspan="2">Общее кол-во:</td>
                <td colspan="3"><?= $cart->getTotalCount()?></td>
            </tr>
            <tr class="success">
                <td colspan="2">Общая сумма:</td>
                <td colspan="3"><?=$cart->getTotalCost() ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else:?>
    <h3>Корзина пуста</h3>
<?php endif;?>