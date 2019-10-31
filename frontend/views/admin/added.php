<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $items frontend\models\Catalog */
?>

<div class="container">
    <div class="row">
    <? foreach($items as $item) : ?>
        <div class="col-md-10 col-md-offset-1 product-div ">
            <div class="inner-product-div-added outer">
                <div class="row middle vertical-align">
                    <div class="img-div col-md-3"><?=Html::img('@web/img/'.$item->good->image, ['height' => 200])?></div>
                    <div class="col-md-9">
                        <div class="item-params"><span class="item-d-header">Название: </span><span><?=$item->good->name?></span></div>
                        <div class="item-params"><span class="item-d-header">Описание: </span><span><?=$item->description?></span></div>
                        <div class="item-params"><span class="item-d-header">Цена: </span><span><?=$item->price?></span></div>
                        <div class="item-params"><span class="item-d-header">Статус: </span><span id="status-span-<?=$item->id?>" data-status="<?=$item->status ? 1 : 0?>"><?=$item->status ? "ОТКРЫТО" : "ЗАКРЫТО"?></span></div>
                        <div class="item-params"><span class="item-d-header">Закупочное кол-во: </span><span><?=$item->req_count?></span></div>
                        <div class="item-params">
                            <span class="item-d-header">Заказано (шт.): </span><span><?=$item->current_count?></span>
                            <? if (!$item->status): ?>
                                <div class="float-right"><button id="oc-button-<?=$item->id?>" class="oc-button btn btn-success" data-id="<?=$item->id?>" data-status="<?=$item->status ? 1 : 0?>">Открыть</button></div>
                            <? else: ?>
                                <div class="float-right"><button id="oc-button-<?=$item->id?>" class="oc-button btn btn-danger" data-id="<?=$item->id?>" data-status="<?=$item->status ? 1 : 0?>">Закрыть</button></div>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
    </div>
</div>
