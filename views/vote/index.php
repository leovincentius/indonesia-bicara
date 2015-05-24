<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Vote</h1>
<?php
$form = ActiveForm::begin(['action' => 'add']);
$form->errorSummary($result, ['class' => 'alert alert-danger']);

if(Yii::$app->session->hasFlash('success')){
    echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('success')."</div>";
}

if(Yii::$app->session->hasFlash('error')){
    echo "<div class='alert alert-danger'>".Yii::$app->session->getFlash('error')."</div>";
}
?>

<h3><?= $vote->title ?></h3>
<?php
foreach($vote->options as $option){
    ?>
    <p><?= $form->field($result, 'option_id')->radio(['value' => $option->id, 'label' => $option->name]) ?></p>
    <?php
}
?>

<?php
echo Html::submitButton('Save', ['class' => 'btn btn-primary']);
ActiveForm::end();
?>
