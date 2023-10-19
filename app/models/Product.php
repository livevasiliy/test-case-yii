<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property int $group_id
 * @property string $article
 * @property string $title
 * @property string $image
 * @property string $price
 * @property int $stock
 * @property string $created_at
 * @property string $deleted_at
 * @property int|null $brand_id
 *
 * @method static Product|null findOne() findOne($condition)
 */
class Product extends \yii\db\ActiveRecord
{
    public const DEFAULT_PAGE_SIZE_VALUE = 12;

    public const DEFAULT_CACHE_DURATION_VALUE = 300;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @return ActiveQuery
     */
    public static function getProductsGroupedByGroupId(): ActiveQuery
    {
        return self::find()
            ->andWhere(['deleted_at' => null])
            ->groupBy(['product.group_id', 'product.id']);
    }

    public function getBrand(): ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public static function getDataProviderProductsByGroupWithSorting(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::DEFAULT_PAGE_SIZE_VALUE,
            ],
            'sort' => [
                'attributes' => [
                    'price' => [
                        'asc' => ['MIN(price)' => SORT_ASC],
                        'desc' => ['MIN(price)' => SORT_DESC],
                        'label' => 'по цене',
                    ],
                    'stock' => [
                        'asc' => ['MAX(stock)' => SORT_ASC],
                        'desc' => ['MAX(stock)' => SORT_DESC],
                        'label' => 'по остаткам',
                    ],
                    'created_at' => [
                        'asc' => ['MAX(created_at)' => SORT_ASC],
                        'desc' => ['MAX(created_at)' => SORT_DESC],
                        'label' => 'по новизне',
                    ],
                ],
                'defaultOrder' => [
                    'price' => SORT_ASC,
                ],
            ],
        ]);
    }

    public static function getTotalStocks(ActiveQuery $query): int
    {
        $totalStock = Yii::$app->cache->get('totalStock');
        if ($totalStock === false) {
            $totalStock = $query->sum('stock');
            Yii::$app->cache->set('totalStock', $totalStock, self::DEFAULT_CACHE_DURATION_VALUE);
        }

        return $totalStock;
    }

}
