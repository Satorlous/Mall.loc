<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $goods frontend\models\Good */
?>
<div class="container-fluid">
    <div class="row">
        <? foreach($goods as $good):?>
        <div class="col-md-3 product-div">
            <a style="text-decoration: none" href="<?=Url::toRoute(['admin/add', 'id' => $good->id])?>">
                <div class="inner-product-div outer">
                    <div class="row middle">
                        <div class="col-md-12 inner"><?=Html::img('@web/img/'.$good->image, ['width' => 150, 'class' => 'center-block'])?></div>
                        <div class="col-md-12 inner"><?=$good->name?></div>
                    </div>
                </div>
            </a>
        </div>
        <? endforeach;?>
    </div>
</div>
