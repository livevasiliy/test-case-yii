<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(): string
    {
        $query = Product::getProductsGroupedByGroupId();
        $dataProvider = Product::getDataProviderProductsByGroupWithSorting($query);
        $totalStock = Product::getTotalStocks($query);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'totalStock'   => $totalStock,
        ]);
    }
}
