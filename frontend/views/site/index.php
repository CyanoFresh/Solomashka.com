<?php
use common\models\Slide;
use frontend\widgets\Alert;
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend/site', 'Home');

$slides = [];
foreach (Slide::find()->orderBy('sortOrder')->all() as $slide) {
    /** @var $slide common\models\Slide */
    $slides[] = [
        'content' => Html::img(Yii::$app->urlManager->baseUrl . '/uploads/slide/' . $slide->id . '.jpg'),
        'caption' => Html::tag('h1', $slide->title) . $slide->body,
    ];
}
?>

<?= Carousel::widget([
    'id' => 'home-slider',
    'items' => $slides,
    'options' => [
        'class' => 'slide',
        'data-interval' => 8000,
    ],
    'controls' => [
        '<span class="icon-prev"></span>',
        '<span class="icon-next"></span>',
    ],
]) ?>

<div class="home-message">
    Этот сайт возник из-за необходимости показать всем Вам моё умение работать с натуральными материалами для украшений. Своеобразный хенд мейд. Украшений представлено очень и очень много. Некоторые из них повторить я уже не смогу, так как не повторяются материалы, они эксклюзивны. В своих работах я использую в основном натуральные бусины яшмы, агата, граната, флюорита, коралла, малахита, янтаря, бычьего и тигрового глаз, натуральные кабошоны, срезы, бисер как японский так и чешский Прециоза. Натуральная кожа - самый любимый материал, которым можно создавать просто шедевры. В процессе изготовления колье, ожерелья, бус, кулонов может очень легко родиться набор: все перечисленное плюс серьги, плюс кольцо, плюс браслет. Техники я использую разные - бисероплетение, нанизывание бусин, кручение и ковка медной проволоки, вязание, вышивка бисером. Появилась новинка в моем творчестве - применение срезов дерева, которые обработаны и составлены в композицию. Стили совершенно разные - БОХО, классическое бисерное плетение, фристайл бисерный, чеканка (металл), резьба по дереву. Мне интересно общаться с клиентом и вместе участвовать в дизайне украшения. Учитываются все пожелания заказчика. Принципиально не работаю с фурнитурой цвета золота (оно предательски слазит после нескольких надеваний).
</div>

<div class="container">

    <?= Alert::widget() ?>

    <h1 class="page-header text-center">
        <?= Yii::t('frontend/site', 'Last products') ?>
    </h1>

    <?= ListView::widget([
        'layout' => "<div class=\"row\">{items}</div>",
        'dataProvider' => $dataProvider,
        'itemView' => '/catalog/_product',
        'viewParams' => [
            'class' => 'col-lg-3 col-md-3 col-sm-4 col-xs-6'
        ],
        'summaryOptions' => [
            'class' => 'alert alert-info'
        ],
    ]) ?>

</div>
