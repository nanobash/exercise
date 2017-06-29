<?php

use \yii\helpers\Url;
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

\app\assets\BaseAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="container-fluid baseWrap">
    <div class="row baseHeader">
        <div class="col-md-6">
            <ul class="baseHeader__ul">
                <li>Klienditeenindus</li>
                <li class="baseHeader__ul__li"><img src="<?= Url::base(); ?>/pictures/ico-customerservice.png" style="position: relative; top: 2px;"> +372 644 0467</li>
                <li class="baseHeader__ul__li"><img src="<?= Url::base(); ?>/pictures/ico-openingtimes.png" style="position: relative; top: 2px;"> E-P 9.00-21.00</li>
            </ul>
        </div>

        <div class="col-md-6">
            <span class="baseHeader__note">
                Tere, Kaupo Kasutaja
            </span>

            <input type="button" class="baseHeader__menu__btn" value="Log Out">
        </div>
    </div>

    <div class="row logoHeader">
        <div class="col-md-3">
            <div class="baseHeader__logo">
                <a href="<?= Url::current(); ?>"><img src="<?= Url::base(); ?>/pictures/header-logo.png" alt="CreditStar" style="position: relative; top: 14px; left: 15px;"></a>
            </div>
        </div>

        <div class="col-md-6">
            <ul class="logoHeader__menu">
                <li><a href="<?= Url::current(); ?>">Add</a></li>
                <li><a href="<?= Url::base(); ?>/index.php/site" target="_blank">Here</a></li>
                <li><a href="http://yiiframework.com" target="_blank">Random</a></li>
                <li><a href="https://creditstar.ee" target="_blank">CREDITSTAR</a></li>
            </ul>
        </div>

        <div class="col-md-3">
            <span class="logoHeader__lang"><a href="#">По-русски</a></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 gridHeader">
            <div class="gridHeader__content">
                <ul class="gridHeader__menu">
                    <li><a href="#">My Actions</a></li>
                    <li><a href="#">Loans</a></li>
                    <li><a href="#">Users</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="baseContainer">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
