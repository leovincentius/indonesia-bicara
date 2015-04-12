<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vote */
/* @var $form yii\widgets\ActiveForm */
?>


<script>
    function newField(value){
        var newField = '<p><input type="text" name="Vote[options][]" value="'+value+'"><a href="javascript:;" onclick="deleteOption(this)"><span class="fa fa-times"></span></a></p>';
        return newField;
    }

    function addNewOption(){
        var newOption = $("#newOption").val();
        $("#opsi").append(newField(newOption));
        $("#newOption").val("");
    }

    function deleteOption(e){
        $(e).parent().remove();
    }
</script>

<div class="col-lg-8 vote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 200]) ?>

    <label>Opsi Pilihan</label><br>
    <div class="input-group">
        <?= Html::input('text', '', '', ['id' => 'newOption', 'class' => 'form-control']) ?>
        <span class="input-group-btn">
            <?= Html::button('<span class=\'fa fa-plus\'></span> Tambah Opsi', [
                    'class' => 'btn btn-danger',
                    'onClick' => 'addNewOption(this)',
                ]) ?>
        </span>
    </div>

    <div id="opsi">
        <br>
        <?php
        foreach($model->options as $key => $option){
            ?>
            <p><input type="text" name="" value="<?=$option->name?>" disabled></p>
            <?php
        }
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<span class=\'fa fa-plus\'></span> Save' : '<span class=\'fa fa-save\'></span> Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
