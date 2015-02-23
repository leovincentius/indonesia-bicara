<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vote */

$this->title = 'Create Vote';
$this->params['breadcrumbs'][] = ['label' => 'Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
   	<p>
        <?= Html::a('<span class=\'fa fa-list\'></span> List Vote', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
<div class="vote-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
