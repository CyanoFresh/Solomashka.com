<?php
use common\models\Page;
use frontend\assets\AppAsset;
use frontend\components\NavBar;
use frontend\widgets\Form;
use kartik\icons\Icon;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

// FontAwesome icons
Icon::map($this, Icon::FA);

// Page models
$pages = Page::findAll(['menu' => true]);
?>
<!--
Built on Yii2 Framework
Author: Alex Solomaha <cyanofresh@gmail.com> (CyanoFresh)
Links: http://solomaha.com/ http://vk.com/alexsolomaha
-->
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - <?= Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'id' => 'menu',
            'brandLabel' => 'Solomashka<span class="hidden-xs"> - интернет-магазин дизайнерских украшений</span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => Yii::t('frontend', 'Home'), 'url' => ['site/index']],
            ['label' => Yii::t('frontend', 'Catalog'), 'url' => ['catalog/index']],
        ];
        foreach ($pages as $page) {
            $menuItems[] = [
                'label' => $page->name,
                'url' => ['page/view', 'slug' => $page->slug],
            ];
        }
        $menuItems[] = [
            'label' => Yii::t('frontend', 'Search'),
            'url' => ['search/index'],
        ];
        $menuItems[] = [
            'label' => Icon::show('shopping-cart') . Yii::t('frontend', 'Cart') . '&nbsp' . Html::tag('span',
                    Yii::$app->cart->getCount(), ['class' => 'badge']),
            'url' => ['cart/index'],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'id' => 'menu-navbar',
            'items' => $menuItems,
            'encodeLabels' => false,
        ]);
        NavBar::end();
        ?>

        <?= $content ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer" id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h3>Контакты</h3>
                        <ul>
                            <li class="supportLi">
                                <h4>
                                    <i class="fa fa-phone"></i>
                                    <?= Yii::$app->params['contactPhone'] ?>
                                </h4>
                                <h4>
                                    <i class="fa fa-envelope"></i>
                                    <?= Yii::$app->params['contactEmail'] ?>
                                </h4>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h3><?= Yii::t('frontend', 'Shop') ?></h3>
                        <ul>
                            <li><?= Html::a(Yii::t('frontend', 'Home'), ['site/index']) ?></li>
                            <li><?= Html::a(Yii::t('frontend', 'Catalog'), ['catalog/index']) ?></li>
                            <?php foreach ($pages as $page): ?>
                                <li><?= Html::a($page->name, ['page/view', 'slug' => $page->slug]) ?></li>
                            <?php endforeach ?>
                            <li><?= Html::a(Yii::t('frontend', 'Search'), ['search/index']) ?></li>
                            <li><?= Html::a(Yii::t('frontend', 'Cart'), ['cart/index']) ?></li>
                        </ul>
                    </div>

                    <div class="col-sm-4">
                        <h3><?= Yii::t('frontend', 'Stay In Touch') ?></h3>

                        <?= Form::widget() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p class="pull-left">
                    © <?= Yii::$app->name ?> <?= date('Y') ?>. <?= Yii::t('frontend', 'All rights reserved') ?>. <a
                        href="http://solomaha.com/">Автор сайта</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-41682146-1', 'auto');
      ga('send', 'pageview');

    </script>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
