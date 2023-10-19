<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = 'Каталог';
?>
<div class="cat">

    <?php /* всего и сортировка */ ?>
    <div class="cat__header">

        <?php /* всего */ ?>
        <div class="cat__total">
            Всего остатков: <?= $totalStock ?> шт.
        </div>

        <?php /* сортировка */ ?>
        <div class="cat__sort">
            <?php foreach ($dataProvider->sort->attributes as $name => $attr): ?>
                <?php
                $label = $attr['label'];
                if ($turn = $dataProvider->sort->attributeOrders[$name] ?? null) {
                    $label .= $turn === SORT_ASC ? '↑' : '↓';
                }
                ?>
                <?= Html::a(Html::encode($label), $dataProvider->sort->createUrl($name)) ?>
            <?php endforeach; ?>
        </div>
    </div>

    
    <?php /* элементы */ ?>
    <div class="cat__items">
        <?php foreach ($dataProvider->models as $product): ?>
            <?php /** @var app\models\Product $product */ ?>
            <div class="prd">
                <div class="prd__pic">
                    <img class="prd__img" src="<?= Html::encode($product->image) ?>" alt="">
                </div>
                <div class="prd__info">
                    <div class="prd__price"><?= Html::encode($product->price) ?> ₽</div>
                    <div class="prd__title"><?= Html::encode($product->title) ?></div>
                    <div class="prd__article">Артикул: <?= Html::encode($product->article) ?></div>
                    <div class="prd__stock">Остаток: <?= Html::encode($product->stock) ?></div>
                    <div class="prd__brand">Бренд: <?= !empty($product->brand) ? Html::encode($product->brand->name) : "Не указан" ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    
    <?php /* пагинация */ ?>
    <div class="cat__pagination">
        <div class="pagination">
            <?php for ($i = 1; $i <= $dataProvider->pagination->pageCount; $i++): ?>
                <?= Html::a($i, $dataProvider->pagination->createUrl($i - 1), [
                    'class' => 'pagination__item' . ($i === ($dataProvider->pagination->page ?: 1) ? ' _active' : ''),
                ]) ?>
            <?php endfor; ?>
        </div>
    </div>

</div>