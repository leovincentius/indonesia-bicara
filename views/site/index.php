<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
$theme = "@web/themes/indonesiabicara/assets";
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Muda, Inspiratif dan Berdampak</h1>

        <p class="lead">
            Indonesia Berbicara merupakan organisasi kemahasiswaan berskala nasional 
            untuk berbicara mengenai isu-isu politik, baik dalam maupun luar negeri
        </p>

        <p><?= Html::a("<span class='glyphicon glyphicon-search'></span> Hasil Diskusi", "hasilDiskusi.html", ['class' => 'btn btn-lg btn-info']) ?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-6">
                <?= Html::img("$theme/images/home.png") ?>
            </div>
            <div class="col-md-3"> 
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu 1 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Submenu 1-1</a></li>
                            <li><a href="#">Submenu 1-2</a></li>
                            <li><a href="#">Submenu 1-3</a></li>                        
                        </ul>
                    </li>
                    <li><a href="#">Menu 2</a></li>
                    <li><a href="#">Menu 3</a></li>
                </ul>
            </div>
            <div class="clearfix visible-lg"></div>
        </div>

    </div>
</div>