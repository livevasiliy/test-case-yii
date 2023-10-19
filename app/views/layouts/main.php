<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $content
 */

$this->registerCsrfMetaTags();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="stylesheet" href="/css/main.css">
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="root">
        <main class="main">
            <?= $content ?>
        </main>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
