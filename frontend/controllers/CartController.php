<?php

namespace frontend\controllers;

use frontend\models\CartItems;
use frontend\models\Catalog;
use frontend\models\Good;
use Yii;
use yii\helpers\Html;

class CartController extends \yii\web\Controller
{
    /**
     * @var \devanych\cart\Cart $cart
     */
    private $cart;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cart = Yii::$app->cart;
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'cart' => $this->cart,
        ]);
    }

    public function actionTest()
    {

    }
    public function actionAdd($id = null, $qty = 1)
    {
        try {
            if (Yii::$app->request->isAjax)
            {
                $id = Yii::$app->request->post('id');
                $qty = Yii::$app->request->post('qty');
            }
            $product = $this->getProduct($id);
            if ($item = $this->cart->getItem($product->id)) {
            } else {
                $this->cart->add($product, $qty);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        if (Yii::$app->request->isAjax)
        {
            return 'Добавлено';
        }
        return $this->redirect(['index']);
    }

    public function actionChange($id, $qty = 1)
    {
        try {
            $product = $this->getProduct($id);
            if ($item = $this->cart->getItem($product->id)) {
                $this->cart->change($item->getId(), $qty);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionRemove($id = null)
    {
        if (Yii::$app->request->isAjax)
        {
            $id = Yii::$app->request->post('id');
        }
        try {
            $product = $this->getProduct($id);
            $this->cart->remove($product->id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        if (Yii::$app->request->isAjax)
        {
            return 'Удалено';
        }
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    public function actionClear()
    {
        $this->cart->clear();
        return $this->redirect(['index']);
    }

    public function actionOrder($id, $qty)
    {
        $catalog_item = Catalog::findOne(['good_id' => $id]);
        $catalog_item->current_count+= $qty;
        $catalog_item->save();
        $cart_item = CartItems::findOne(['product_id' => $id, 'user_id' => Yii::$app->getUser()->id]);
        $cart_item->ordered = true;
        $cart_item->save();
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    private function getProduct($id)
    {
        if (($product = Good::findOne((int)$id)) !== null) {
            return $product;
        }
        throw new \DomainException('Товар не найден');
    }

    /**
     * @param integer $qty
     * @param integer $maxQty
     * @return integer
     * @throws \DomainException if the product cannot be found
     */
    private function getQuantity($qty, $maxQty)
    {
        $quantity = (int)$qty > 0 ? (int)$qty : 1;
        if ($quantity > $maxQty) {
            throw new \DomainException('Товара в наличии всего ' . Html::encode($maxQty) . ' шт.');
        }
        return $quantity;
    }
}
