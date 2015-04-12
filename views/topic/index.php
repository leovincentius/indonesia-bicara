<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumbotron">
    <div class="topic">
        <h1><?= Html::encode($model->title) ?></h1>

        <?= $model->description ?>

        <hr>

        <?php

        //TODO: baru 1 level - akan dilakukan recursive
        foreach($model->comments as $key => $comment){
            ?>
            <h2><?= $comment->title ?></h2>
            <div><?= $comment->content ?></div>
            <?php
        }
        ?>

        -- Form comment will be here --
    </div>
</div>
