<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vote */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-view">

    <p>
        <?= Html::a('<span class=\'fa fa-list\'></span> List Vote', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class=\'fa fa-plus\'></span> Create Vote', ['create'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class=\'fa fa-edit\'></span> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class=\'fa fa-trash-o\'></span> Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $totalVote = $model->getTotalVote()[0]['total'];
    $options = "";
    foreach($model->options as $option){
        $options .= '<div class="progress">'
                .'<div class="progress-bar" role="progressbar" style="width: '.($option->getResults()->count()/$totalVote*100).'%;">'
                .$option->name.' - '.$option->getResults()->count()
                .'</div></div>';
    }
    $options .= "";
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'admin.name',
            'title',
            'create_date',
            'update_date',
            [
                'attribute' => 'options',
                'value' => $options,
                'format' => 'html',
            ]
        ],
    ]) ?>

</div>
