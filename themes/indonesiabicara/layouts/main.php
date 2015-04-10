<?php

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string */

$theme = "@web/themes/indonesiabicara/assets";
$this->registerCssFile("$theme/bootstrap.min.css");
$this->registerJsFile("$theme/jquery.min.js");
$this->registerJsFile("$theme/bootstrap.min.js");
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head(); ?>
    </head>
    <body>
        <?php $this->beginBody(); ?>
        <div class="container-fluid">
            <div class="row" style="margin-top:40px;">
                <div class="col-md-5">
                    <center><?= Html::img("$theme/images/logo.png", ['class' => 'img-responsive']) ?></center>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-5">
                    Muda, Inspiratif, dan Berdampak
                    <?= Html::a(Html::img("$theme/images/fb.png"), "http://facebook.com") ?>
                    <?= Html::a(Html::img("$theme/images/tweet.png"), "http://twitter.com") ?>
                    <?= Html::a(Html::img("$theme/images/mail.png"), "http://gmail.com") ?>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div>
                    <ul class="nav navbar-nav">
                        <li><?= Html::a('Home', ['site/index']) ?></li>
                        <li><?= Html::a('Tentang Kami', ['site/about']) ?></li>
                        <li><?= Html::a('Struktur Organisasi', ['site/organize']) ?></li>
                        <li><a href="diskusi.html">Diskusi</a></li>
                        <li><a href="hasilDiskusi.html">Hasil Diskusi</a></li>
                        <li><?= Html::a('Kerjasama Institusi', ['site/coop']) ?></li>
                        <li><?= Html::a('Contact', ['site/contact']) ?></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <!--<div class="jumbotron">-->
                <?php echo $content; ?>
            <!--</div>-->
        </div>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>
