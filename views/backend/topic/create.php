<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Topic */

$this->title = 'Create Topic';
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
   	<p>
        <?= Html::a('<span class=\'fa fa-list\'></span> List Topic', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
<div class="topic-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
