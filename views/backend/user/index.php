<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Filter</h4>
            </div>

            <div class="modal-body">
                                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="user-index">


    <p>
        <?= Html::a('<span class=\'fa fa-plus\'></span> Create User', ['create'], ['class' => 'btn btn-success']) ?>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filter">
            <span class='fa fa-search'></span> Filter
        </button>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'email:email',
            'name',
            'photo',
            // 'status',
            // 'last_login',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
